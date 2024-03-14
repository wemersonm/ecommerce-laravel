<?php


namespace App\Services;

use App\Classes\Cart\CartCalculator;
use App\Exceptions\CartItemNotExistException;
use App\Exceptions\DiscountCuponInvalidException;
use App\Exceptions\DiscountCuponUsedByTheUserException;
use App\Exceptions\ErrorSystem;
use App\Exceptions\MaxProductExceededExecption;
use App\Exceptions\ProductExistInCartException;
use App\Exceptions\ProductNotExistException;
use App\Exceptions\ProductOutOfStockException;
use App\Http\Resources\AddProductAtCartResource;
use App\Http\Resources\CartResource;
use App\Models\User;
use App\Repositories\Interfaces\CartRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Facades\Http;
use Throwable;


class CartService
{
  public function __construct(
    private CartRepositoryInterface $cartRepository,
    private ProductRepositoryInterface $productRepository,
  ) {

  }

  public function serviceGetProductsInCart(array $data)
  {
    /** @var \App\Models\User $user */
    try {


      $user = auth()->user();
      $products = $this->manageItemsFromCart($user, $data['update_qty'] ?? [], $data['delete_item'] ?? 0);
      [$cupon, $products] = $this->discountCuponValidate($products, $data['cupon'] ?? "", $user);
      $shipping = $this->calculateShipping($products, $data['cep'] ?? "", $data['shipping_code'] ?? "");
      $products = $this->calculateProductsWithDiscountCupon($products, $cupon);
      $totals = $this->calculateCartTotals($products, $cupon, $shipping);
      $return = [
        'itens' => $products,
        'cupon' => $cupon,
        'shipping' => $shipping,
        'totals' => $totals,
      ];

      return new CartResource($return);

    } catch (Throwable $th) {
      return $th;
      return $this->responseError(
        class_basename($th),
        $th->getMessage(),
        $th->statusCode ?? 500, // phpcs:ignore
      );
    }
  }

  public function calculateCartTotals(object $products, object|array $cupon, object|array $shipping): array
  {

    $shippingSelected = $shipping ? $shipping->filter(fn($item) => $item['is_selected'])->first() : null;
    $shippingSelected = $shippingSelected ?? [];

    $cartCalculator = new CartCalculator($products, $shippingSelected);

    return get_object_vars($cartCalculator);
  }

  public function calculateProductsWithDiscountCupon(object $products, object|array $cupon)
  {

    if (!$cupon) {
      return $products;
    }
    $productsWithCupon = $products->map(function ($item) use ($cupon) {
      if ($cupon->name == $item->discount_cupon_name) {
        $item->price_discount_cupon =
          $cupon->type == 'PERCENTAGE' ?
          $item->product->price * ($cupon->value / 100) :
          ($cupon->type == 'FIXED_VALUE' ? $cupon->value : 0);

        $item->cash_discount_cupon =
          $cupon->type == 'PERCENTAGE' ?
          $item->product->cash_price * ($cupon->value / 100) :
          ($cupon->type == 'FIXED_VALUE' ? $cupon->value : 0);
      }
      return $item;
    });
    return $productsWithCupon;
  }

  public function manageItemsFromCart(User $user, array $update, int $IdDelete)
  {

    $products = $this->cartRepository->getAllProductsFromCart($user);

    if ($update) {
      $cartItemForUpdate = $products->cartItem->where('id', $update['id'])->first();
      !$cartItemForUpdate ? throw new CartItemNotExistException : null;
      $update['qty'] > $cartItemForUpdate->product->max_quantity
        && $products->cartItem->product->stock < $update['qty'] ?
        throw new MaxProductExceededExecption : null;
      $this->cartRepository->updateQuantityProductInCart($cartItemForUpdate, $update['qty']);
    }

    if ($IdDelete) {
      $cartItemForDelete = $products->cartItem->where('id', $IdDelete)->first();
      !$cartItemForDelete ? throw new CartItemNotExistException : null;
      $products->cartItem->except($cartItemForDelete->getKey());
    }

    $products = $products->cartItem->map(function ($item) {
      $item->is_active = $item->product->stock > 0;
      if ($item->product->stock < $item->quantity) {
        $item->quantity = $item->product->stock;
      }
      return $item;
    });

    $products = $products->map(function ($item) {
      if ($item->isDirty('quantity')) {
        $item->quantity_modified = (object) [
          'modified' => true,
          'old_value' => $item->getOriginal('quantity'),
        ];
      }
      return $item;
    });

    $idsFromUpdateQuantity = $products->filter(function ($item) {
      if (isset ($item->quantity_modified) && $item->quantity_modified->modified) {
        return $item;
      }
    })->pluck('id')->toArray();

    $updated = !empty ($idsFromUpdateQuantity) ?
      $this->cartRepository->updateQuantityProductThatExceedTheProdutcStok($idsFromUpdateQuantity) :
      null;

    return $products;
  }


  public function calculateShipping(object $products, string $cep, $shipping_code)
  {
    if (!$cep) {
      return [];
    }

    $prods = $products->map(function ($item) {
      return [
        'id' => $item->product->id,
        'width' => $item->product->width,
        'height' => $item->product->height,
        'length' => $item->product->length,
        'weight' => ($item->product->weight) / 100,
        'insurance_value' => $item->product->price * 0.6,
        'quantity' => $item->quantity,
      ];
    });

    $response = Http::withHeaders([
      'Content-Type' => 'application/json',
      'Accept' => 'application/json',
      'Authorization' => 'Bearer ' . env('API_KEY_SHIPPING'),
    ])->post(
        env('URL_API_SHIPPING'),
        [
          "from" => [
            "postal_code" => env('FROM_POSTAL_CODE')
          ],
          "to" => [
            "postal_code" => $cep
          ],
          'products' => $prods,
          'options' => [
            'receipt' => true,
          ]
        ]
      );

    if ($response->successful()) {
      $typesShipping = $this->formatTypesShipping($response->collect(), $shipping_code);

      return $typesShipping;
    }
    if ($response->failed()) {
      return [];
    }
  }

  public function formatTypesShipping(object $shippings, $shipping_code)
  {
    $shippingsValid = $shippings->filter(fn($item) => !isset ($item['error']));
    return $shippingsValid ? $shippingsValid->map(function ($item) use ($shipping_code) {
      $item['is_selected'] = $shipping_code == $item['id'];
      return $item;
    })->values() : [];
  }

  public function discountCuponValidate(object $products, $cupon, User $user)
  {
    $nameCuponApplied = $this->checkExisitOnlyOneDiscountCuponApplied($products);
    $requestCupon = $cupon;
    $discountCuponApplied = null;

    if (!$requestCupon && !$nameCuponApplied) {
      return [];
    }
    if (!$requestCupon && $nameCuponApplied) {
      $this->removeDiscountCupon($products);
      return [];
    }
    if ($nameCuponApplied) {
      $discountCuponApplied = $this->checkDiscountCuponValidity($nameCuponApplied, $user);
    }
    if (isset ($discountCuponApplied['error']) && $discountCuponApplied['error']) {
      $this->removeDiscountCupon($products->cartItem);
      return [];
    }
    if (!$nameCuponApplied) {
      $discountCuponApplied = $requestCupon ? $this->checkDiscountCuponValidity($requestCupon, $user) : null;
    }
    $idsProductsForApplyDiscountCupon = false;
    if (!is_null($discountCuponApplied) && !isset ($discountCuponApplied['error'])) {
      $idsProductsForApplyDiscountCupon = $this->validateAndSetDiscountCuponInProducts($products, $discountCuponApplied);
      is_null($idsProductsForApplyDiscountCupon) ? throw new ErrorSystem('error at update cupons') : null;
      $products = $products->map(function ($item) use ($idsProductsForApplyDiscountCupon, $discountCuponApplied) {
        if (in_array($item->id, $idsProductsForApplyDiscountCupon)) {
          $item->discount_cupon_name = $discountCuponApplied->name;
        }
        return $item;
      });
    }
    return $idsProductsForApplyDiscountCupon ?
      [$discountCuponApplied, $products] : [array('is_valid' => false, 'cupon' => $requestCupon, ), $products];
  }

  public function checkExisitOnlyOneDiscountCuponApplied(object $cartItem)
  {
    $cuponsApplied = $cartItem->whereNotNull('discount_cupon_name')->pluck('discount_cupon_name')->unique();
    if ($cuponsApplied->count() > 1) {
      $this->removeDiscountCupon($cartItem);
      return false;
    }
    return $cuponsApplied[0] ?? false;
  }

  public function removeDiscountCupon(object $cartItem)
  {
    $idsCartItem = $cartItem->pluck('id')->toArray();
    $this->cartRepository->removeDiscountCupon($idsCartItem);

  }

  public function checkDiscountCuponValidity(string $nameCupon, User $user)
  {
    try {
      $cupon = $this->cartRepository->getDiscountCupon($nameCupon);
      !$cupon ? throw new DiscountCuponInvalidException() : null;
      !$cupon->is_valid ? throw new DiscountCuponInvalidException() : null; // acessor 'is_valid'
      $isUsed = $this->cartRepository->userUsedCupon($user, $cupon);
      $isUsed ? throw new DiscountCuponUsedByTheUserException : null;
      return $cupon;
    } catch (Throwable $th) {
      return ['error' => true, 'exception' => class_basename($th), 'message' => $th->getMessage() ?? 'error in validation discount cupon'];
    }
  }

  public function validateAndSetDiscountCuponInProducts(object $products, $discountCupon)
  {
    $idsProductsInCart = $products->pluck('product_id')->toArray();
    $idsCartItem = $products->pluck('id')->toArray();
    $productsInPromotion = $discountCupon->promotion_id ?
      $this->cartRepository->getProductsInPromotionThatAreInCart($idsProductsInCart, $discountCupon->promotion_id) :
      [];
    $cartItemProductsForApplyCupon = $products->filter(function ($item) use ($productsInPromotion, $discountCupon) {
      if (
        ($item->product->category_id == $discountCupon->category_id ||
          $item->product->brand_id == $discountCupon->brand_id ||
          ($discountCupon->promotion_id && in_array($item->product_id, $productsInPromotion->pluck('product_id')->toArray())))
        && ($item->product->price > $discountCupon->min_value)
      ) {
        return $item;
      }
    });

    return $this->setAndRemoveDiscountCupon($cartItemProductsForApplyCupon, $discountCupon->name, $idsCartItem);

  }

  public function setAndRemoveDiscountCupon(object $itemsAplicables, string $nameDiscountCupon, array $idsCartItem)
  {
    if ($itemsAplicables->isEmpty()) {
      return false;
    }
    $idsAplicables = $itemsAplicables->pluck('id')->toArray();
    $updated = $this->cartRepository->setDiscountCuponValuesInCartItem($idsAplicables, $idsCartItem, $nameDiscountCupon);
    return is_null($updated) ? null : $idsAplicables;
  }

  public function updateQuantityProductsInCart(array $data)
  {

  }

  public function serviceAddProductAtCart(array $data)
  {
    /**  @var \App\Models\User $user */
    try {
      $user = auth()->user();
      $quantity = 1;
      $product = $this->productRepository->findById($data['id'], false);
      !$product ? throw new ProductNotExistException : null;
      $cart = $this->cartRepository->findOrCreateCart($user);
      $productExistInCart = $this->cartRepository->productExistInCart($user, $cart, $product->id);

      $productExistInCart ? throw new ProductExistInCartException : null;
      !$product->stock ? throw new ProductOutOfStockException : null;
      $quantity >= $product->max_quantity ? throw new MaxProductExceededExecption : null;
      $inserted = $this->cartRepository->insertProductInCart($user, $cart, ['product_id' => $product->id, 'quantity' => $quantity]);
      return $inserted ?
        new AddProductAtCartResource($inserted)
        : throw new \Exception('error when add product in the cart');

    } catch (Throwable $th) {
      return $this->responseError(class_basename($th), $th->getMessage(), $th->statusCode ?? 500);  // phpcs:ignore
    }
  }

  public function responseError(string $error, string $message, int $code = 400, $data = [])
  {
    return response()->json([
      'error' => $error,
      'message' => $message,
      'data' => $data,
    ], $code);
  }
}

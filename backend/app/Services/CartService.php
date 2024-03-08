<?php


namespace App\Services;

use App\Classes\CartCalculator;
use App\Exceptions\DiscountCuponAlreadyAppliedExcepion;
use App\Exceptions\DiscountCuponInvalidException;
use App\Exceptions\DiscountCuponUsedByTheUserException;
use App\Exceptions\ErrorAtUpdateDiscountCuponInCartItemException;
use App\Exceptions\ErrorSystem;
use App\Exceptions\MaxProductExceededExecption;
use App\Exceptions\ProductExistInCartException;
use App\Exceptions\ProductNotExistException;
use App\Exceptions\ProductNotExistInCartException;
use App\Exceptions\ProductOutOfStockException;
use App\Http\Resources\AddProductAtCartResource;
use App\Http\Resources\CartProductResource;
use App\Http\Resources\CartResource;
use App\Models\CartItem;
use App\Models\DiscountCupon;
use App\Models\Product;
use App\Models\PromotionProduct;
use App\Models\User;
use App\Repositories\Interfaces\CartRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
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
      //itens
      $products = $this->cartRepository->getAllProducts($user);
      // cupon
      $cupon = $this->discountCuponValidate($products, $data['cupon'] ?? "", $user);
      // frete


      $prods = $products->cartItem->map(function ($item) {
        return [
          'id' => $item->product->id,
          'width' => $item->product->width / 2,
          'height' => $item->product->height / 2,
          'length' => $item->product->length / 2,
          'weight' => $item->product->weight / 100,
          'insurance_value' => $item->product->price,
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
              "postal_code" => "74914050"
            ],
            "to" => [
              "postal_code" => "04382-070"
            ],
            'products' => $prods
          ]
        );

      return $response;



    } catch (Throwable $th) {
      return $th;
      return $this->responseError(
        class_basename($th),
        $th->getMessage(),
        $th->statusCode ?? 500, // phpcs:ignore
      );
    }
  }







  public function discountCuponValidate(object $products, $cupon, User $user)
  {
    $nameCuponApplied = $this->checkExisitOnlyOneDiscountCuponApplied($products->cartItem);
    $requestCupon = $cupon;
    $discountCuponApplied = null;

    if (!$requestCupon && !$nameCuponApplied) {
      return [];
    }
    if (!$requestCupon && $nameCuponApplied) {
      $this->removeDiscountCupon($products->cartItem);
      return [];
    }
    if ($nameCuponApplied) {
      $discountCuponApplied = $this->checkDiscountCouponValidity($nameCuponApplied, $user);
    }
    if (isset($discountCuponApplied['error']) && $discountCuponApplied['error']) {
      $this->removeDiscountCupon($products->cartItem);
      return [];
    }
    if (!$nameCuponApplied) {
      $discountCuponApplied = $requestCupon ? $this->checkDiscountCouponValidity($requestCupon, $user) : null;
    }
    $statusProductsWithDiscountCuponApplied = false;
    if (!is_null($discountCuponApplied) && !isset($discountCuponApplied['error'])) {
      $statusProductsWithDiscountCuponApplied = $this->validateAndSetDiscountCuponInProducts($products, $discountCuponApplied);
      is_null($statusProductsWithDiscountCuponApplied) ? throw new ErrorSystem('error at update cupons') : null;
    }
    return $statusProductsWithDiscountCuponApplied ? $discountCuponApplied : ['is_valid' => false, 'cupon' => $requestCupon,];

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

  public function checkDiscountCouponValidity(string $nameCupon, User $user)
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
    $idsProductsInCart = $products->cartItem->pluck('product_id')->toArray();
    $idsCartItem = $products->cartItem->pluck('id')->toArray();
    $productsInPromotion = $discountCupon->promotion_id ?
      $this->cartRepository->getProductsInPromotionThatAreInCart($idsProductsInCart, $discountCupon->promotion_id) :
      [];
    $cartItemProductsForApplyCupon = $products->cartItem->filter(function ($item) use ($productsInPromotion, $discountCupon) {
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
    return is_null($updated) ? null : true;
  }



  // public function serviceAddProductAtCart(array $data)
  // {
  //   /**  @var \App\Models\User $user */
  //   try {
  //     $user = auth()->user();
  //     $quantity = 1;
  //     $product = $this->productRepository->findById($data['id'], false);
  //     !$product ? throw new ProductNotExistException : null;
  //     $productExistInCart = $this->cartRepository->productExistInCart($user, $product->id);
  //     $productExistInCart ? throw new ProductExistInCartException : null;
  //     !$product->stock ? throw new ProductOutOfStockException : null;
  //     $quantity >= $product->max_quantity ? throw new MaxProductExceededExecption : null;
  //     $inserted = $this->cartRepository->insert($user, ['product_id' => $product->id, 'quantity' => $quantity]);
  //     return $inserted ?
  //       new AddProductAtCartResource($inserted)
  //       : throw new \Exception('error when add product in the cart');

  //   } catch (Throwable $th) {
  //     return $this->responseError(class_basename($th), 'error when add product in the cart');
  //   }
  // }

  // public function serviceRemoveProductAtCart(array $data)
  // {
  //   /**  @var \App\Models\User $user */
  //   try {
  //     $user = auth()->user();
  //     $product = $this->productRepository->findById($data['id'], false);
  //     !$product ? throw new ProductNotExistException : null;
  //     $productExistInCart = $this->cartRepository->productExistInCart($user, $product->id);
  //     !$productExistInCart ? throw new ProductNotExistInCartException : null;
  //     $deleted = $this->cartRepository->delete($productExistInCart);
  //     return $deleted ?
  //       CartProductResource::collection($this->cartRepository->getAllProducts($user))
  //       : throw new \Exception('error when delete product in the cart');
  //   } catch (Throwable $th) {
  //     return $this->responseError(class_basename($th), 'error when delete product in the cart');
  //   }
  // }

  // public function serviceUpdateProductInCart(array $data)
  // {
  //   /**  @var \App\Models\User $user */
  //   try {
  //     $user = auth()->user();
  //     $product = $this->productRepository->findById($data['id'], false);
  //     !$product ? throw new ProductNotExistException : null;
  //     $productExistInCart = $this->cartRepository->productExistInCart($user, $product->id);
  //     !$productExistInCart ? throw new ProductNotExistInCartException : null;
  //     $product->stock < $productExistInCart->quantity ? throw new MaxProductExceededExecption : null;
  //     // verificar se tem estoque para quantity+quantidade que ja tem no carrinho
  //     if ($product->max_quantity > ($data['quantity'] + $productExistInCart->quantity)) {
  //       throw new MaxProductExceededExecption;
  //     }




  //     // !$product->stock ? throw new ProductOutOfStockException : null;
  //     // $quantity >= $product->max_quantity ? throw new MaxProductExceededExecption : null;
  //   } catch (Throwable $th) {
  //     return $this->responseError(class_basename($th), 'error when updated product in the cart');
  //   }
  // }




  public function responseError(string $error, string $message, int $code = 400, $data = [])
  {
    return response()->json([
      'error' => $error,
      'message' => $message,
      'data' => $data,
    ], $code);
  }
}

/* 
            $dataCupon = $this->validateDiscountCupon($products, $user, $data['cupon']);
            return $dataCupon;
            // frete
            // calcular valores produtos + cupom + frete  
            $idsToUpdate = $products->cartItem->filter(function ($item) {
              if ($item->quantity > $item->product->stock) {
                $item->quantity = $item->product->stock;
                return $item;
              }
            })->pluck('id')->toArray();

            !empty($idsToUpdate) ?
              $this->cartRepository->updateQuantityProductInCart($idsToUpdate) : null;

            $products->cartItem->each(function ($item) {
              if ($item->isDirty('quantity')) {
                $item->modified = [
                  'quantity_modified' => true,
                  'old_quantity' => $item->getOriginal('quantity'),
                  'newQuantity' => $item->quantity
                ];
              }
            });
            return
              (new CartResource($products))->additional([
                'totals' => (new CartCalculator($products)),
              ]); */

// return [
//   'name' => $cuponName,
//   'type' => $cuponDetails->type,
//   'min_value' => $cuponDetails->min_value,
//   'discount' => $cuponDetails->value,
// ];
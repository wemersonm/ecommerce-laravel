<?php


namespace App\Services;

use App\Classes\CartCalculator;
use App\Exceptions\DiscountCuponAlreadyAppliedExcepion;
use App\Exceptions\DiscountCuponInvalidException;
use App\Exceptions\DiscountCuponUsedByTheUserException;
use App\Exceptions\LimitMaxDiscountCuponAppliedExcepion;
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
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
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
      $nameCuponApplied = $this->checkExisitOnlyOneDiscountCuponApplied($products->cartItem);
      $requestCupon = $data['cupon'] ?? ""; // se nao vir nada do request em cupom e porque e para remover
      $discountCuponApplied = null;
      /* 
        tests:
        ** Se por acaso o requestCupon for diferente do $nameCuponApplied, o requestCupon assume o cupom que sera o ativo **
        1 - Se tiver cupom aplicado e o cupom que vier, validar o mesmo cupom ja aplicado
        2 - Se tiver cupom aplicado, e o request vir vazio, remover todos os cupons aplicados
        3- se Não tiver cupom aplicado e vier cupom request, validar esse cupom e aplicar
        4- sE nao tiver cupoom aplicado e nao vier, nao faz nada
      */

      if ($nameCuponApplied) { //tem cupom já aplicado
        /* 1- */
        $discountCuponApplied = $this->checkDiscountCouponValidity($nameCuponApplied, $user);
        $discountCuponApplied['error'] ? $this->removeDiscountCupon($products->cartItem) : null;

        /* 2- */
        !$requestCupon ? $this->removeDiscountCupon($products->cartItem) : null;

      }
      if (!$nameCuponApplied) {
        /* 3- */
        $discountCuponApplied = $requestCupon ? $this->checkDiscountCouponValidity($requestCupon, $user) : null;

      }
      if (!is_null($discountCuponApplied) && !isset($discountCuponApplied['error'])) { //cupom e OK
        $productsWithapplicableCupon = $this->validateAndSetDiscountCuponInProducts($products, $discountCuponApplied);

        // salvar no cart_item os produtos que sao aplicavel o cupom

        dd($productsWithapplicableCupon);
      }
      dd($nameCuponApplied);
      // retonrar dados do cupom OU erro do cupom, seja cupom invalido ou vazio / nenhum cupom enviado
      dd('deu ruim no cupom');

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

    } catch (Throwable $th) {
      return $th;
      // return $this->responseError(class_basename($th), $th->getMessage());
    }
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
      return 'nenhum produto com o cupom aplicavel no carrinho';
    }
    $idsAplicables = $itemsAplicables->pluck('id')->toArray();
    /* $query =  CartItem::whereIn('id', $idsCartItem)->where(function ($query) use ($idsAplicables, $nameDiscountCupon) {
      $query->whereIn('id', $idsAplicables)->update(['discount_cupon_name' => $nameDiscountCupon]);
      $query->whereNotIn('id', $idsAplicables)->update(['discount_cupon_name' => NULL]);
    }); */
    $implodeIdsAplicables = implode(',', $idsAplicables);
    $query = CartItem::whereIn('id', $idsCartItem)
      ->update([
        'discount_cupon_name' => DB::raw("CASE 
            WHEN id IN ($implodeIdsAplicables) THEN '$nameDiscountCupon'
            WHEN id NOT IN ($implodeIdsAplicables) AND discount_cupon_name IS NOT NULL THEN NULL
            ELSE '$nameDiscountCupon'
        END")
      ]);

    return $query;
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
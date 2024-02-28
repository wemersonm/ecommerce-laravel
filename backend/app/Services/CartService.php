<?php


namespace App\Services;

use App\Classes\CartCalculator;
use App\Exceptions\DiscountCuponInvalidException;
use App\Exceptions\DiscountCuponUsedByTheUserException;
use App\Exceptions\MaxProductExceededExecption;
use App\Exceptions\ProductExistInCartException;
use App\Exceptions\ProductNotExistException;
use App\Exceptions\ProductNotExistInCartException;
use App\Exceptions\ProductOutOfStockException;
use App\Http\Resources\AddProductAtCartResource;
use App\Http\Resources\CartProductResource;
use App\Http\Resources\CartResource;
use App\Models\DiscountCupon;
use App\Models\PromotionProduct;
use App\Repositories\Interfaces\CartRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
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
      $products = $this->cartRepository->getAllProducts($user);

      return  isset($data['cupon']) ? $this->serviceValidateCupon($data['cupon'], $products->cartItem, $user) : null;


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
        ]);

    } catch (Throwable $th) {
      return $th;
      return $this->responseError(class_basename($th), 'error when getting products from cart');
    }
  }
  public function serviceValidateCupon($nameCupon, $cartItem, $user)
  {
    $cupon = $this->cartRepository->getDiscountCupon($nameCupon);
    !$cupon ? throw new DiscountCuponInvalidException() : null;
    !$cupon->is_valid ? throw new DiscountCuponInvalidException() : null; // acessor 'is_valid'
    $isUsed = $this->cartRepository->userUsedCupon($user, $cupon);
    $isUsed ? throw new DiscountCuponUsedByTheUserException : null;
    $productIds = $cupon->promotion_id ? $cartItem->pluck('product_id')->toArray() : null;
    $productsIsPromotion = !empty($productIds) ? $this->cartRepository->getProductsInPromotionThatAreInCart($productIds, $cupon->promotion_id) : null;
    $cartItem->each(function ($item) use ($cupon, $productsIsPromotion) {
      if (
        $item->product->category_id == $cupon->category_id ||
        $item->product->brand_id == $cupon->brand_id ||
        ($cupon->promotion_id &&
          in_array($item->product->id, $productsIsPromotion->pluck('product_id')->toArray())
        )
      ) {
        $item->cupon = [
          'type' => $cupon->type,
          'discount_value' => $cupon->value,
        ];
      }
    });
    // $isDirty = ? $cartItem : 'deu algum coisa';
    dd( $cartItem->contains(fn($item) => $item->isDirty()));
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
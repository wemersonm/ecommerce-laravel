<?php


namespace App\Services;

use App\Classes\CartCalculator;
use App\Exceptions\MaxProductExceededExecption;
use App\Exceptions\ProductExistInCartException;
use App\Exceptions\ProductNotExistException;
use App\Exceptions\ProductNotExistInCartException;
use App\Exceptions\ProductOutOfStockException;
use App\Http\Resources\AddProductAtCartResource;
use App\Http\Resources\CartProductResource;
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

  public function serviceGetProductsInCart()
  {
    /** @var \App\Models\User $user */
    try {
      $user = auth()->user();
      $products = $this->cartRepository->getAllProducts($user);

      $idsToUpdate = $products->cartItem->filter(function ($item) {
        if ($item->quantity > $item->product->stock) {
          $item->quantity_modified = true;
          $item->quantity = $item->product->stock;
          return $item;
        }
      })->pluck('id')->toArray();

      !empty($idsToUpdate) ?
        $this->cartRepository->updateQuantityProductInCart($idsToUpdate) : null;


      return response()->json((new CartCalculator($products))->intallments);


      // return $products;
      /*  return (new CartResource($products))->additional([
         'totals' => [
           'cash_total' => 2366,
           'forward_total' => 2555,
         ],
         'shipping' => [
           'freight' => 346,
           'type' => 'PAC'
         ],
       ]);
  */
    } catch (Throwable $th) {
      return $th;
      return $this->responseError(class_basename($th), 'error when getting products from cart');
    }
  }

  public function serviceAddProductAtCart(array $data)
  {
    /**  @var \App\Models\User $user */
    try {
      $user = auth()->user();
      $quantity = 1;
      $product = $this->productRepository->findById($data['id'], false);
      !$product ? throw new ProductNotExistException : null;
      $productExistInCart = $this->cartRepository->productExistInCart($user, $product->id);
      $productExistInCart ? throw new ProductExistInCartException : null;
      !$product->stock ? throw new ProductOutOfStockException : null;
      $quantity >= $product->max_quantity ? throw new MaxProductExceededExecption : null;
      $inserted = $this->cartRepository->insert($user, ['product_id' => $product->id, 'quantity' => $quantity]);
      return $inserted ?
        new AddProductAtCartResource($inserted)
        : throw new \Exception('error when add product in the cart');

    } catch (Throwable $th) {
      return $this->responseError(class_basename($th), 'error when add product in the cart');
    }
  }

  public function serviceRemoveProductAtCart(array $data)
  {
    /**  @var \App\Models\User $user */
    try {
      $user = auth()->user();
      $product = $this->productRepository->findById($data['id'], false);
      !$product ? throw new ProductNotExistException : null;
      $productExistInCart = $this->cartRepository->productExistInCart($user, $product->id);
      !$productExistInCart ? throw new ProductNotExistInCartException : null;
      $deleted = $this->cartRepository->delete($productExistInCart);
      return $deleted ?
        CartProductResource::collection($this->cartRepository->getAllProducts($user))
        : throw new \Exception('error when delete product in the cart');
    } catch (Throwable $th) {
      return $this->responseError(class_basename($th), 'error when delete product in the cart');
    }
  }

  public function serviceUpdateProductInCart(array $data)
  {
    /**  @var \App\Models\User $user */
    try {
      $user = auth()->user();
      $product = $this->productRepository->findById($data['id'], false);
      !$product ? throw new ProductNotExistException : null;
      $productExistInCart = $this->cartRepository->productExistInCart($user, $product->id);
      !$productExistInCart ? throw new ProductNotExistInCartException : null;
      $product->stock < $productExistInCart->quantity ? throw new MaxProductExceededExecption : null;
      // verificar se tem estoque para quantity+quantidade que ja tem no carrinho
      if ($product->max_quantity > ($data['quantity'] + $productExistInCart->quantity)) {
        throw new MaxProductExceededExecption;
      }




      // !$product->stock ? throw new ProductOutOfStockException : null;
      // $quantity >= $product->max_quantity ? throw new MaxProductExceededExecption : null;
    } catch (Throwable $th) {
      return $this->responseError(class_basename($th), 'error when updated product in the cart');
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
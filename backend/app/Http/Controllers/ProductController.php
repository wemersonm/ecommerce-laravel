<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProductAtCartRequest;
use App\Http\Requests\RemoveProductAtCartRequest;
use App\Http\Resources\AddProductAtCartResource;
use App\Http\Resources\CardProductResource;
use App\Models\CartProduct;
use App\Models\FavoriteProduct;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;


class ProductController extends Controller
{
  public function __construct(
    private ProductService $productService
  ) {
    $this->middleware(['auth:sanctum'])->only(['addProductAtCart', 'removeProductAtCart', 'addProductToFavorite']);
  }
  public function getFlashSales()
  {
    return $this->productService->serviceGetFlashSales();
  }
  public function getBestSellers(Request $request)
  {
    $data = $request->validate(['limit' => ['sometimes', 'numeric']]);
    return $this->productService->serviceGetBestSellers($data['limit'] ?? 8);
  }

  public function getOurProducts(Request $request)
  {
    $data = $request->validate([
      'limit' => 'sometimes|numeric',
    ]);
    return $this->productService->serviceGetOurProducts($data['limit'] ?? 8);
  }

 /*  public function addProductAtCart(AddProductAtCartRequest $request)
  {
    $data = $request->validated();
    return $this->productService->serviceAddProductAtCart($data);
  }

  public function removeProductAtCart(RemoveProductAtCartRequest $request)
  {
    $data = $request->validated();
    $userId = auth()->user()->id;

    $productInTheUserCart = CartProduct::where('product_id', $data['id'])->where('user_id', $userId)->first();
    $productInTheUserCart->delete();
    return CartProduct::where('user_id', $userId)->get();

  }

 */
  public function addProductToFavorite(Request $request)
  {
    $data = $request->validate([
      'id' => 'numeric',
    ]);

    $product = Product::find($data['id']);
    if (!$product)
      throw new \Exception('product not exist');

    $user = auth()->user();

    $created = $user->favorites()->create([
      'product_id' => $data['id'],
    ]);

    return $created ? ['id' => $created->id] : throw new \Exception('error at add to favorites');

  }
  public function removeProductToFavorite(Request $request)
  {
    $data = $request->validate([
      'id' => 'numeric',
    ]);
    $userId = auth()->user()->id;
    $productInFavorites = FavoriteProduct::where('product_id', $data['id'])->where('user_id', $userId)->first();
    if (!$productInFavorites)
      throw new \Exception('product not exist in favorites');

    $productInFavorites->delete();
    return FavoriteProduct::where('product_id', $data['id'])->where('user_id', $userId)->get();
  }


}

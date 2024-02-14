<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProductAtCartRequest;
use App\Http\Requests\RemoveProductAtCartRequest;
use App\Http\Resources\AddProductAtCartResource;
use App\Http\Resources\CardProductResource;
use App\Models\CartProduct;
use App\Models\FavoriteProduct;
use App\Models\Product;
use Database\Factories\ProductFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
  public function __construct()
  {
    $this->middleware(['auth:sanctum'])->only(['addProductAtCart', 'removeProductAtCart', 'addProductToFavorite']);
  }
  public function getFlashSales()
  {
    if (Cache::has('flash_sale_products')) {
      $products = json_decode(Cache::get('flash_sale_products'));
      return CardProductResource::collection($products);
    }
    $products = Product::where('is_flash_sale', true)->get();
    return CardProductResource::collection($products);
  }
  public function getBestSellers(Request $request)
  {
    $request->validate([
      'limit' => 'numeric',
    ]);

    if (Cache::has('best_sellers_products')) {
      return CardProductResource::collection(json_decode(Cache::get('best_sellers_products')));
    }
    $products = Product::orderBy('sold', 'desc')->take($request->input('limit', 8))->get();
    return CardProductResource::collection(($products));
  }

  public function getOurProducts(Request $request)
  {
    $request->validate([
      'limit' => 'numeric',
    ]);
    if (Cache::has('our_products')) {
      return CardProductResource::collection(json_decode(Cache::get('our_products')));
    }
    $products = Product::where('rating', '>=', 4.5)->orderBy('sold', 'desc')->take($request->input('limit', 8))->get();
    return CardProductResource::collection(($products));
  }

  public function addProductAtCart(AddProductAtCartRequest $request)
  {
    $data = $request->validated();
    $product = Product::find($data['id']);
    if (!$product)
      throw new \Exception('product not exist');
    $user = auth()->user();

    $created = $user->cart()->create([
      'product_id' => $product->id,
      'quantity' => $data['quantity'],
    ]);
    return $created ? (new AddProductAtCartResource($created)) : throw new \Exception('error add product at cart');
  }

  public function removeProductAtCart(RemoveProductAtCartRequest $request)
  {
    $data = $request->validated();
    $userId = auth()->user()->id;

    $productInTheUserCart = CartProduct::where('product_id', $data['id'])->where('user_id', $userId)->first();
    $productInTheUserCart->delete();
    return CartProduct::where('user_id', $userId)->get();

  }


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

<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProductAtCartRequest;
use App\Http\Resources\AddProductAtCartResource;
use App\Http\Resources\CardProductResource;
use App\Models\CartProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
  public function __construct()
  {
    $this->middleware(['auth:sanctum'])->only(['addProductFavorites']);
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

  public function removeProduct()
  {
    
  }

}

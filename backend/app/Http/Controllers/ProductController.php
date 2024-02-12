<?php

namespace App\Http\Controllers;

use App\Http\Resources\CardProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{

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

}

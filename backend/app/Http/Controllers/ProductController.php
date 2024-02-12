<?php

namespace App\Http\Controllers;

use App\Http\Resources\CardProductResource;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{

  public function getFlashSales()
  {
    $products = json_decode(Cache::get('flash_sale_products'));
    return CardProductResource::collection($products);
  }

}

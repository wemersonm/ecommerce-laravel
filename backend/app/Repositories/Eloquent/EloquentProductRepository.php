<?php

namespace App\Repositories\Eloquent;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Facades\DB;

class EloquentProductRepository implements ProductRepositoryInterface
{
  public function getFlashSalesProducts()
  {
    return Product::where('is_flash_sale', true)->get();
  }
  public function getBestSellersProducts(int $limit)
  {
    return Product::orderBy('sold', 'desc')->take($limit)->get();
  }
  public function getOurProducts(int $limit)
  {
    return Product::where('rating', '>=', 4.5)->orderBy('sold', 'desc')->take($limit)->get();
  }

  public function findById(int $id, bool $modelNotFoundException = true)
  {
    return $modelNotFoundException ? Product::findOrFail($id) : Product::find($id);
  }
}
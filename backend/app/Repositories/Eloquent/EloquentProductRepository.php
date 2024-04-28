<?php

namespace App\Repositories\Eloquent;

use App\Models\Product;
use App\Models\User;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Facades\DB;

class EloquentProductRepository implements ProductRepositoryInterface
{
    public function getProductsOnFlashSales()
    {
        return Product::where('is_flash_sale', true)->get();
    }
    public function getProductsBestSellers(int $limit)
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
    public function getProductBySlug(string $slug)
    {
        return Product::where('slug', $slug)->first();
    }
    public function getInfoProduct(Product $product)
    {
        return $product->load(['brand', 'category', 'promotions.promotion']);
    }
}

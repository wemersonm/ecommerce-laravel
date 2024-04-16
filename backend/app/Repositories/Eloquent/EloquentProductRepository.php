<?php

namespace App\Repositories\Eloquent;

use App\Models\Product;
use App\Models\User;
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
    public function addProductAtFavorites(int $id, User $user)
    {
        return $user->favorites()->create(['product_id' => $id]);
    }

    public function existInFavorites(int $id, User $user)
    {
        return $user->favorites()->where('product_id', $id)->first();
    }

    public function removeProductAtFavorites(int $idFavorite, User $user)
    {
        return $user->favorites()->whereId($idFavorite)->delete();
    }

    public function countFavorites(User $user)
    {
        return $user->favorites()->count();
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

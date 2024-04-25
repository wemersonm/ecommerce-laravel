<?php

namespace App\Repositories\Eloquent;

use App\Models\Favorite;
use App\Repositories\Interfaces\FavoriteRepositoryInterface;

class EloquentFavoriteRepository implements FavoriteRepositoryInterface
{
    public function getAllFavorites(int $user_id)
    {
        return Favorite::where("user_id", $user_id)->latest()->with('product')->get();

    }
    public function existFavorite(int $user_id, int $product_id)
    {
        return Favorite::where('user_id', $user_id)->where('product_id', $product_id)->exists();
    }

    public function createFavorite(int $user_id, int $product_id): Favorite
    {
        return Favorite::create([
            'user_id' => $user_id,
            'product_id' => $product_id,
        ]);
    }
    public function deleteFavorite(int $user_id, int $product_id): int
    {
        return Favorite::where('user_id', $user_id)->where('product_id', $product_id)->delete();
    }
}

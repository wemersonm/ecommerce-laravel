<?php

namespace App\Repositories\Interfaces;

use App\Models\User;
use App\Models\Favorite;
use Illuminate\Support\Collection;

interface FavoriteRepositoryInterface
{
    public function getAllFavorites(int $user_id);
    public function existFavorite(int $user_id, int $product_id);
    public function createFavorite(int $user_id,int $product_id): Favorite;
    public function deleteFavorite(int $user_id,int $product_id): int;

}

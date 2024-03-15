<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Interfaces\FavoritesRepositoryInterface;

class EloquentFavoritesRepository implements FavoritesRepositoryInterface
{
  public function getAllProductFavorites(User $user)
  {
    return $user->favorites()->get();
  }

}

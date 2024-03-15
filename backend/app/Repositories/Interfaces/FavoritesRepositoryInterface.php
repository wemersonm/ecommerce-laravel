<?php

namespace App\Repositories\Interfaces;
use App\Models\User;

interface FavoritesRepositoryInterface
{
  public function getAllProductFavorites(User $user);
 
}

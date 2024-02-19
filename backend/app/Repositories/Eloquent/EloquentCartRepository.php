<?php

namespace App\Repositories\Eloquent;

use App\Models\CartProduct;
use App\Models\User;
use App\Repositories\Interfaces\CartRepositoryInterface;

class EloquentCartRepository implements CartRepositoryInterface
{
  public function getAllProducts(User $user)
  {
    return $user->cart()->with('product.brand')->latest()->get();

  }
  public function productExistInCart(User $user, int $id)
  {
    return $user->cart()->where('product_id', $id)->first();
  }
  public function insert(User $user, array $data)
  {
    return $user->cart()->create($data);

  }

  public function delete(CartProduct $product)
  {
    return $product->delete(); 
  }
}
<?php


namespace App\Repositories\Interfaces;
use App\Models\CartProduct;
use App\Models\User;

interface CartRepositoryInterface
{
  public function getAllProducts(User $user);

  public function productExistInCart(User $user,int $id);
  public function insert(User $user,array $data);

  public function delete(CartProduct $product);
  
}
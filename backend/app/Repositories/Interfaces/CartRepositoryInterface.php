<?php


namespace App\Repositories\Interfaces;

use App\Models\CartProduct;
use App\Models\DiscountCupon;
use App\Models\User;
use Illuminate\Support\Collection;

interface CartRepositoryInterface
{
  public function getAllProducts(User $user);

  public function productExistInCart(User $user, int $id);
  public function insert(User $user, array $data);

  public function delete($product);
  public function updateQuantityProductInCart(array $ids);


  public function getDiscountCupon(string $nameCupon);
  public function userUsedCupon(User $user, DiscountCupon $discountCupon);
  public function getProductsInPromotionThatAreInCart(array $idsProducts, int $promotion_id);

}
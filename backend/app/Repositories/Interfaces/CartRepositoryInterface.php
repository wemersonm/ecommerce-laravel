<?php


namespace App\Repositories\Interfaces;

use app\Models\Cart;
use App\Models\CartItem;
use App\Models\DiscountCupon;
use App\Models\User;
use Illuminate\Support\Collection;

interface CartRepositoryInterface
{
  public function getAllProductsFromCart(User $user);

  public function productExistInCart(User $user, Cart $cart, int $id);
  public function insertProductInCart(User $user, Cart $cart, array $data);
  public function findOrCreateCart(User $user);

  public function delete($product);
  public function updateQuantityProductInCart(CartItem $cartItem, int $quantity);
  public function updateQuantityProductThatExceedTheProdutcStok(array $ids);

  public function getDiscountCupon(string $nameCupon);
  public function userUsedCupon(User $user, DiscountCupon $discountCupon);
  public function getProductsInPromotionThatAreInCart(array $idsProducts, int $promotion_id);


  public function removeDiscountCupon(array $idsCartItem);
  public function setDiscountCuponValuesInCartItem(array $idsAplicables, array $idsCartItem, string $nameDiscountCupon);

  public function deleteItemFromCart(CartItem $item);

}
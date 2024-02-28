<?php

namespace App\Repositories\Eloquent;

use App\Models\CartItem;
use App\Models\CartProduct;
use App\Models\DiscountCupon;
use App\Models\PromotionProduct;
use App\Models\UsageDiscountCupon;
use App\Models\User;
use App\Repositories\Interfaces\CartRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class EloquentCartRepository implements CartRepositoryInterface
{
  public function getAllProducts(User $user)
  {
    return $user->cart()->with([
      'cartItem' => function ($query) {
        return $query->latest()->get();
      },
      'cartItem.product.brand',
      
    ])->latest()->first();

  }
  public function productExistInCart(User $user, int $id)
  {
    return $user->cart()->where('product_id', $id)->first();
  }
  public function insert(User $user, array $data)
  {
    return $user->cart()->create($data);

  }
  public function delete($product)
  {
    return $product->delete();
  }

  public function updateQuantityProductInCart(array $idsToUpdate)
  {
    try {
      $updated = DB::update("UPDATE cart_items
                INNER JOIN products
                ON products.id = cart_items.product_id
                SET cart_items.quantity = products.stock
                WHERE cart_items.id IN (" . implode(',', $idsToUpdate) . ")");
      return $updated;
    } catch (\Throwable $th) {
      throw $th;
    }
  }




  public function getDiscountCupon(string $nameCupon)
  {
    return DiscountCupon::where('name', $nameCupon)->first();
  }
  public function userUsedCupon(User $user, DiscountCupon $discountCupon)
  {
    return UsageDiscountCupon::where('user_id', $user->id)->where('discount_cupon_id', $discountCupon->id)->exists();
  }

  public function getProductsInPromotionThatAreInCart(array $idsProducts, int $promotion_id)
  {
    return PromotionProduct::where('promotion_id', $promotion_id)->whereIn('product_id', $idsProducts)->get();

  }


}
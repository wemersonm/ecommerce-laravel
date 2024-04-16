<?php

namespace App\Repositories\Eloquent;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\DiscountCupon;
use App\Models\PromotionProduct;
use App\Models\UsageDiscountCupon;
use App\Models\User;
use App\Repositories\Interfaces\CartRepositoryInterface;
use Illuminate\Support\Facades\DB;

class EloquentCartRepository implements CartRepositoryInterface
{
    public function getAllProductsFromCart(User $user)
    {
        return $user->cart()->with([
            'cartItem' => function ($query) {
                return $query->latest()->get();
            },
            'cartItem.product.brand',

        ])->latest()->first();
    }
    public function productExistInCart(User $user, Cart $cart, int $id)
    {
        return $user->cart()->where('id', $cart->id)->whereHas('cartItem', function ($query) use ($id) {
            $query->where('product_id', $id);
        })->exists();
    }
    public function insertProductInCart(User $user, Cart $cart, array $data)
    {
        return CartItem::create(array_merge($data, ['cart_id' => $cart->id]));
    }
    public function delete($product)
    {
        return $product->delete();
    }

    public function updateQuantityProductThatExceedTheProdutcStok(array $idsToUpdate)
    {
        try {
            $updated = CartItem::join('products', 'products.id', '=', 'cart_items.product_id')
                ->whereIn('cart_items.id', $idsToUpdate)
                ->update([
                    'cart_items.quantity' => DB::raw("products.stock"),
                ]);
            return $updated;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function updateQuantityProductInCart(CartItem $cartItem, int $quantity)
    {
        return $cartItem->update(['quantity' => $quantity]);
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
    public function removeDiscountCupon(array $idsCartItem)
    {
        CartItem::whereIn('id', $idsCartItem)->whereNotNull('discount_cupon_name')->update([
            'discount_cupon_name' => null,
        ]);
    }

    public function setDiscountCuponValuesInCartItem($idsAplicables, $idsCartItem, $nameDiscountCupon)
    {

        try {
            DB::beginTransaction();
            CartItem::whereIn('id', $idsCartItem)->whereIn('id', $idsAplicables)
                ->whereRaw('(discount_cupon_name != ? OR discount_cupon_name IS NULL)', [$nameDiscountCupon])
                ->update(['discount_cupon_name' => $nameDiscountCupon]);

            CartItem::whereIn('id', $idsCartItem)
                ->whereNotIn('id', $idsAplicables)
                ->whereNotNull('discount_cupon_name')
                ->update(['discount_cupon_name' => NULL]);
            DB::commit();
            return true;
        } catch (\Throwable) {
            DB::rollBack();
            return null;
        }
    }


    public function findOrCreateCart(User $user)
    {
        return $user->cart()->latest()->firstOrCreate();
    }

    public function deleteItemFromCart(CartItem $item)
    {
        return $item->delete();
    }
}

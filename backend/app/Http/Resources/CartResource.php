<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'cart' => [
                'id' => $this->id,
                'cart_items' => CartItemResource::collection($this->cartItem),
            ]

        ];
    }
}

class CartItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'is_active' => $this->is_active,
            'id' => $this->id,
            'quantity' => $this->quantity,
            'quantity_modified' => $this->quantity_modified ?? false,
            'created_at' => $this->created_at,
            'product' => new ProductResource($this->product),
        ];
    }
}

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->image,
            'slug' => $this->slug,
            'brand' => $this->brand->name,
            'stock' => $this->stock,
            'is_flash_sale' => $this->is_flash_sale,
            'discount' => $this->discount,
            'max_quantity' => $this->max_quantity,
            'price' => (float) $this->price,
            'cash_price' => $this->price * ((100 - $this->discount) / 100),
            // cupons => cuponinfo, cupon_discount, cupon_cacsh_discount, 
            'rating' => $this->rating,
            'reviews' => $this->reviews,
            'sku' => $this->sku,
        ];
    }
}


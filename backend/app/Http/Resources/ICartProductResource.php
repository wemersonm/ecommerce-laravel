<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->product->id,
            'name' => $this->product->name,
            'image' => $this->product->image,
            'slug' => $this->product->slug,
            'brand' => $this->product->brand->name,
            'stock' => $this->product->stock,
            'is_flash_sale' => $this->product->is_flash_sale,
            'discount' => $this->product->discount,
            'max_quantity' => $this->product->max_quantity,
            'quantity' => $this->quantity,
            'price' => $this->product->price,
            'cash_price' => $this->product->price * ((100 - $this->product->discount) / 100),
            // cupons => cuponinfo, cupon_discount, cupon_cacsh_discount, 
            'rating' => $this->product->rating,
            'reviews' => $this->product->reviews,
            'sku' => $this->product->sku,
            'created_at' => $this->product->created_at,
            'active_in_cart' => $this->product->stock > 0 ? true : false,
        ];
    }
}

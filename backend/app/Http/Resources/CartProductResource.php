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
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->image,
            'slug' => $this->slug,
            'brand' => $this->brand->name,
            'stock' => $this->stock,
            'is_flash_sale' => $this->is_flash_sale,
            'discount' => $this->discount,
            'max_quantity' => $this->max_quantity,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'cash_price' => $this->cash_price,
            'rating' => $this->rating,
            'reviews' => $this->reviews,
            'sku' => $this->sku,
            'created_at' => $this->created_at,
        ];
    }
}

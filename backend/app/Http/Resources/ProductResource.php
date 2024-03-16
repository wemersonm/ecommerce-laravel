<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'flash_sale' => $this->flash_sale,
            'rating' => $this->rating,
            'reviews' => $this->reviews,
            'sold' => $this->sold,
            'stock' => $this->stock,
            'is_favorite' => isset ($this->favorite),
            'price' => $this->price,
            'cash_price' => $this->cash_price,
            'discount' => $this->discount,
            'brand' => $this->brand->name,
            'category' => $this->category->name,
            'promotions' => $this->promotions ? $this->promotions->map(function ($item) {
                return [
                    'name' => $item->promotion->name,
                    'is_valid' => $item->promotion->is_valid,
                ];
            })->toArray() : [],
        ];
    }
}

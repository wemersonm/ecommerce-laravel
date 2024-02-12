<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CardProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' =>  $this->name,
            'stock' =>  $this->stock,
            'price' =>  $this->price,
            'slug' => $this->slug,
            'image' => $this->image,
            'rating' => $this->rating,
            'reviews' => $this->reviews,
            'is_flash_sale' => $this->is_flash_sale,
            'sku' => $this->is_flash_sale,
        ];
    }
}

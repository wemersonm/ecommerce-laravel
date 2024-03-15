<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductFavoriteResource extends JsonResource
{

    public static $wrap = "json";

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'created_at' => $this->created_at,
            'product' => [
                'id' => $this->product->id,
                'brand' => $this->product->brand->name,
                'name' => $this->product->name,
                'slug' => $this->product->slug,
                'price' => $this->product->price,
                'cash_price' => $this->product->cash_price,
                'rating' => $this->product->rating,
                'reviews' => $this->product->reviews,
            ]
        ];
    }
}

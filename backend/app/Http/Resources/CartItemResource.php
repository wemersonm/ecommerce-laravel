<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'is_active' => $this->is_active,
            'id' => $this->id,
            'cupon_name' => $this->discount_cupon_name,
            'quantity' => $this->quantity,
            'quantity_modified' => (isset($this->quantity_modified) && $this->quantity_modified->modified) ? $this->quantity_modified : false,
            'created_at' => $this->created_at,
            'product' => new CartProductResource($this->product),
        ];
    }
}

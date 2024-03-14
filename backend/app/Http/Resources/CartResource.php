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
            'itens' => CartItemResource::collection($this->resource['itens']),
            'shipping' => new CartShippingResource($this->resource['shipping']),
            'cupon' => new CartDiscountCuponResource($this->resource['cupon']),
            'totals' => new CartTotalsResource($this->resource['totals']),
        ];
    }
}



<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartTotalsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'forward_price_products' => $this['forward_price_products'],
            'cash_price_products' => $this['cash_price_products'],
            'cash_discount_cupon' => $this['cash_discount_cupon'],
            'price_discount_cupon' => $this['price_discount_cupon'],
            'shipping_value' => $this['shipping_value'],
            'forward_total_cart' => $this['forward_total_cart'],
            'cash_total_cart' => $this['cash_total_cart'],
            'installment' => [
                'parcels' => $this['installment']->parcels,
                'value' => $this['installment']->value,
                'forward_price' => $this['forward_price_products'],
            ],

        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartShippingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->resource->map(function ($item) {
            return [
                'id' => $item['id'],
                'name' => $item['name'],
                'custom_price' => $item['custom_price'],
                'discount' => $item['discount'],
                'total_price' => $item['custom_price'] - $item['discount'],
                'currency' => $item['currency'],
                'delivery_time' => $item['delivery_time'],
                'delivery_time_min' => $item['delivery_range']['min'],
                'delivery_time_max' => $item['delivery_range']['max'],
                'custom_delivery_time' => $item['custom_delivery_time'],
                'custom_delivery_range_min' => $item['custom_delivery_range']['min'],
                'custom_delivery_range_max' => $item['custom_delivery_range']['max'],
                'company' => $item['company']['name'],

            ];
        })->toArray();

    }
}

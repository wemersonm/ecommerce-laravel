<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'address_type' => [
                'address_type_id' => $this->address_type_id,
                'address_type_name' => $this->address_type_name
            ],
            'recipient' => $this->recipient,
            'cep' => $this->cep,
            'street' => $this->street,
            'number' => $this->number,
            'complement' => $this->complement,
            'neighborhood' => $this->neighborhood,
            'city' => $this->city,
            'uf' => $this->uf,
            'reference' => $this->reference,
            'main' => $this->main,
        ];
    }
}

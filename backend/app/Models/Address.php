<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    use HasFactory;

    const ADDRESS_TYPE_ID = [
        'RESIDENTIAL' => 1,
        'COMMERCIAL' => 2,
        'OTHER' => 3,
    ];
    const ADDRESS_TYPE_NAME = [
        'RESIDENTIAL' => "Residencial",
        'COMMERCIAL' => "Comercial",
        'OTHER' => "Outro"
    ];
    protected $fillable = [
        "user_id",
        "name",
        "address_type",
        "recipient",
        "cep",
        "street",
        "number",
        "complement",
        "neighborhood",
        "city",
        "uf",
        "reference",
        "main",
    ];

    protected $appends = [
        'address_type_id',
        'address_type_name'
    ];

    public function addressTypeId(): Attribute
    {
        return Attribute::make(
            get: fn($value) => self::ADDRESS_TYPE_ID[$this->attributes['address_type']],
        );
    }
    public function addressTypeName(): Attribute
    {
        return Attribute::make(
            get: fn() => self::ADDRESS_TYPE_NAME[$this->attributes['address_type']],
        );
    }
}

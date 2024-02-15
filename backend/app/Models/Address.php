<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "address_type",
        "Recipient",
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
}

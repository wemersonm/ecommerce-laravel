<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'brand_id',
        'stock',
        'slug',
        'weight',
        'height',
        'width',
        'length',
        'image',
        'rating',
        'reviews',
        'discount',
        'is_flash_sale',
        'max_quantity',
        'sku',
    ];
}

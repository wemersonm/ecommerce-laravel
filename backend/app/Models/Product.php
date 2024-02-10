<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected string $table = "products";
    protected array $fillable = [
        'name',
        'category_id',
        'brand_id',
        'stock',
        'slug',
        'weight',
        'height',
        'width',
        'lenght',
        'image',
        'rating',
        'reviews',
    ];
}

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

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }
    public function promotions()
    {
        return $this->hasMany(PromotionProduct::class, 'product_id', 'id');
    }
    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'product_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id', 'id');
    }
}

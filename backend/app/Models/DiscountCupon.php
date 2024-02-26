<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountCupon extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "description",
        "type",
        "value",
        "min_value",
        "usage_limit",
        "usage",
        "valid_from",
        "valid_until",
        "category_id",
        "brand_id",
        "promotion_id"
    ];

    protected $appends = ['is_valid', 'is_used'];
    public function getIsValidAttribute()
    {
        $now = Carbon::now()->format('Y-m-d H:i:s');
        return $this->valid_from < $now && $this->valid_until > $now;
    }

    public function getIsUsedAttribute()
    {
        return $this->usage()->with('user');
    }


    public function used()
    {
        return $this->hasMany(UsageDiscountCupon::class, 'discount_cupon_id', 'id');
    }

}

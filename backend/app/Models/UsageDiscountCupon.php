<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsageDiscountCupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'discount_cupon_id',
        'user_id'
    ];



    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id', 'description', 'rating', 'likes'];
    protected $appends = ['review_date'];

    public function ReviewDate(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->created_at->format('d/m/Y'),
        );
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}

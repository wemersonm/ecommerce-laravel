<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;


    protected string $table = "brands";

    protected array $fillable = [
        'name',
        'slug',
        'image',
    ];

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $appends = ['is_valid'];

    protected function IsValid(): Attribute
    {
        return Attribute::make(
            get: function (): bool {
                return now()->between($this->valid_from, $this->valid_until);
            }
        );
    }
}

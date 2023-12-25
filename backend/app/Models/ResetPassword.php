<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResetPassword extends Model
{
    use HasFactory;

    const UPDATED_AT = null;
    protected $table = "password_reset_tokens";
    protected $primaryKey = "id";
    protected $fillable = [
        "email", "token",
    ];
}

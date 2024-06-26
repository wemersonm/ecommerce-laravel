<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResetEmail extends Model
{
    use HasFactory;

    const UPDATED_AT = null;

    protected $table = 'email_reset_tokens';
    protected $fillable = [
        'email',
        'token',
    ];


}

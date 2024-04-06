<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResetEmail extends Model
{
    use HasFactory;

    protected $table = 'email_reset_tokens';
    protected $fillable = [
        'current_email',
        'new_email',
        'token',
    ];


}

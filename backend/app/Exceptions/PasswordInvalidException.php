<?php

namespace App\Exceptions;

use Exception;

class PasswordInvalidException extends Exception
{

    protected $message = 'password invalid';
    public function render()
    {
        return response()->json([
            'error' => class_basename($this),
            'message' => $this->getMessage(),
        ], 401);
    }
}

<?php

namespace App\Exceptions;

use Exception;

class PasswordInvalidException extends Exception
{

    protected $message = 'password invalid';
    public int $statusCode = 401;

    public function render()
    {
        return response()->json([
            'error' => class_basename($this),
            'message' => $this->getMessage(),
        ], $this->statusCode);
    }
}

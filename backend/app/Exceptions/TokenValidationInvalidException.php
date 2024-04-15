<?php

namespace App\Exceptions;

use Exception;

class TokenValidationInvalidException extends Exception
{

    protected $message = 'token invalid or used or expired';
    public int $statusCode = 422;

    public function render()
    {
        return response()->json([
            "error" => class_basename($this),
            "message" => $this->getMessage(),
        ], $this->statusCode);
    }
}

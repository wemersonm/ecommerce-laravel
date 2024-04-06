<?php

namespace App\Exceptions;

use Exception;

class TokenOrEmailChangeEmailInvalidException extends Exception
{
    protected $message = 'token change email invalid or used or expired';
    public int $statusCode = 404;

    public function render()
    {
        return response()->json([
            "error" => class_basename($this),
            "message" => $this->getMessage(),
        ], $this->statusCode);
    }
}

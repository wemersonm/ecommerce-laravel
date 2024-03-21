<?php

namespace App\Exceptions;

use Exception;

class TokenOrEmailChangeEmailInvalidException extends Exception
{
    protected $message = 'token change email invalid or used or expired';

    public function render()
    {
        return response()->json([
            "error" => class_basename($this),
            "message" => $this->getMessage(),
        ], 404);
    }
}

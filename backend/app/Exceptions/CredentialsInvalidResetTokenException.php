<?php

namespace App\Exceptions;

use Exception;

class CredentialsInvalidResetTokenException extends Exception
{
    protected $message = "token reset password invalid";
    public int $statusCode = 404;

    public function render()
    {
        return response()->json([
            'error' => class_basename($this),
            'message' => $this->getMessage(),
        ], $this->statusCode);
    }
}

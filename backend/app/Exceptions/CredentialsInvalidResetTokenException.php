<?php

namespace App\Exceptions;

use Exception;

class CredentialsInvalidResetTokenException extends Exception
{
    protected $message = "token reset password invalid";

    public function render()
    {
        return response()->json([
            'error' => class_basename($this),
            'message' => $this->getMessage(),
        ], 404);
    }
}

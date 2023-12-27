<?php

namespace App\Exceptions;

use Exception;

class UserNotExistsException extends Exception
{
    protected $message = "user not exists in system";

    public function render()
    {
        return response()->json([
            'error' => class_basename($this),
            'message' => $this->getMessage(),
        ], 404);
    }
}

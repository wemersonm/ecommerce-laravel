<?php

namespace App\Exceptions;

use Exception;

class ErrorValidationException extends Exception
{
    protected $message = "validations fail";

    public function render()
    {
        return response()->json([
            'error' => class_basename($this),
            'message' => $this->getMessage(),
        ], 422);
    }
}

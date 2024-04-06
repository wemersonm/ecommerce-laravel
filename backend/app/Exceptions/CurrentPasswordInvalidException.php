<?php

namespace App\Exceptions;

use Exception;

class CurrentPasswordInvalidException extends Exception
{
    protected $message = 'current password invalid';
    public int $statusCode = 400;

    public function render()
    {
        return response()->json([
            'error' => class_basename($this),
            'message' => $this->getMessage(),
        ], $this->statusCode);
    }
}

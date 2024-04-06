<?php

namespace App\Exceptions;

use Exception;

class EmailSameRegisteredException extends Exception
{
    protected $message = 'Email same registered';
    public int $statusCode = 404;

    public function render()
    {
        return response()->json([
            "error" => class_basename($this),
            "message" => $this->getMessage(),
        ], $this->statusCode);
    }
}

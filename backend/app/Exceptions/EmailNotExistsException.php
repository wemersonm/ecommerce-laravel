<?php

namespace App\Exceptions;

use Exception;

class EmailNotExistsException extends Exception
{
    protected $message = 'Email not exists in system';
    public int $statusCode = 404;

    public function render()
    {
        return response()->json([
            "error" => class_basename($this),
            "message" => $this->getMessage(),
        ], $this->statusCode);
    }
}

<?php

namespace App\Exceptions;

use Exception;

class ProductNotExistInCartException extends Exception
{
    protected $message = 'product not exist in cart';
    public int $statusCode = 400;

    public function render()
    {
        return response()->json([
            'error' => class_basename($this),
            'message' => $this->getMessage(),
        ], $this->statusCode);
    }
}

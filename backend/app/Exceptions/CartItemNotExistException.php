<?php

namespace App\Exceptions;

use Exception;

class CartItemNotExistException extends Exception
{
    protected $message = 'cart item not exist';
    public int $statusCode = 400;

    public function render()
    {
        return response()->json([
            'error' => class_basename($this),
            'message' => $this->getMessage(),
        ], $this->statusCode);
    }
}

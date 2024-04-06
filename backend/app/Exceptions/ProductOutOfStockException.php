<?php

namespace App\Exceptions;

use Exception;

class ProductOutOfStockException extends Exception
{
    protected $message = 'product out of stock';
    public int $statusCode = 400;

    public function render()
    {
        return response()->json([
            'error' => class_basename($this),
            'message' => $this->getMessage(),
        ], $this->statusCode);
    }
}

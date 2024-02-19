<?php

namespace App\Exceptions;

use Exception;

class ProductOutOfStockException extends Exception
{
    protected $message = 'product out of stock';

    public function render()
    {
        return response()->json([
            'error' => class_basename($this),
            'message' => $this->getMessage(),
        ], 400);
    }
}

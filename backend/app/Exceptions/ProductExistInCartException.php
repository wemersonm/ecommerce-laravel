<?php

namespace App\Exceptions;

use Exception;

class ProductExistInCartException extends Exception
{
    
    protected $message = 'product exist in cart';

    public function render()
    {
        return response()->json([
            'error' => class_basename($this),
            'message' => $this->getMessage(),
        ], 400);
    }
}

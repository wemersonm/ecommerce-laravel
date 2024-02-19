<?php

namespace App\Exceptions;

use Exception;

class ProductNotExistException extends Exception
{
    protected $message = 'product not exist';

    public function render()
    {
        return response()->json([
            'error' => class_basename($this),
            'message' => $this->getMessage(),
        ], 400);
    }
}

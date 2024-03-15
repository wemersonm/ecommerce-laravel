<?php

namespace App\Exceptions;

use Exception;

class ProductExistInFavoritesException extends Exception
{
    protected $message = 'product exist in favorites';

    public function render()
    {
        return response()->json([
            'error' => class_basename($this),
            'message' => $this->getMessage(),
        ], 400);
    }
}

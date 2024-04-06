<?php

namespace App\Exceptions;

use Exception;

class DiscountCuponInvalidException extends Exception
{
    protected $message = "discount cupon don't exist";
    public int $statusCode = 400;

    public function render()
    {
        return response()->json([
            'error' => class_basename($this),
            'message' => $this->getMessage(),
        ], $this->statusCode);
    }
}

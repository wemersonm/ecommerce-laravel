<?php

namespace App\Exceptions;

use Exception;

class DiscountCuponUsedByTheUserException extends Exception
{
    protected $message = "discount cupon used by the user";

    public function render()
    {
        return response()->json([
            'error' => class_basename($this),
            'message' => $this->getMessage(),
        ]);
    }

}

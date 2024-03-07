<?php

namespace App\Exceptions;

use Exception;

class LimitMaxDiscountCuponAppliedExcepion extends Exception
{
    
    protected $message = 'limit max discount cupon already applied in the cart (max:1)';
    public function render()
    {
        return response()->json([
            'error' => class_basename($this),
            'message' => $this->getMessage(),
        ], 422);
    }
}

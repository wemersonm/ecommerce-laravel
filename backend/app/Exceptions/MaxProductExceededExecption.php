<?php

namespace App\Exceptions;

use Exception;

class MaxProductExceededExecption extends Exception
{
    protected $message = 'max quantity products allowed in the cart exceeded';

    public function render()
    {
        return response()->json([
            'error' => class_basename($this),
            'message' =>  $this->getMessage(),
        ],400);
    }
}

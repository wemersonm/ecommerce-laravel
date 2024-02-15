<?php

namespace App\Exceptions;

use Exception;

class AddressNotExistException extends Exception
{
    protected $message = 'address not exist';

    public function render()
    {
        return response()->json([
            'error' => class_basename($this),
            'message' => $this->getMessage(),
        ],400);
    }
}

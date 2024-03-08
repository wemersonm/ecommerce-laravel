<?php

namespace App\Exceptions;

use Exception;

class ErrorSystem extends Exception
{

    protected $message = 'error in system';
    public $statusCode = 500;
    public function render()
    {
        return response()->json([
            'error' => class_basename($this),
            'message' => $this->getMessage(),
        ], $this->statusCode);
    }
}

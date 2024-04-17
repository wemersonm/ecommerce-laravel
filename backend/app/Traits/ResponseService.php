<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

trait ResponseService
{

    public function responseError($th, string $message = "", $data = []): JsonResponse
    {
        $code =
            $th instanceof HttpException ?
            $th->getStatusCode() : ($th->statusCode ?? 500);
        return Response::json([
            'error' => class_basename($th),
            'message' => $message ? $message : $th->getMessage(),
            'data' => $data,
        ], $code ?? 500);
    }

    public function responseSuccess($data, $code = 200, $cookie = null)
    {
        $response = Response::json($data, $code);
        $response = $cookie ? $response->cookie($cookie) : $response;
        return $response;
    }
}

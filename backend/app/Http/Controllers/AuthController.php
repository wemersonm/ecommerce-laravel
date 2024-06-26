<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Resources\UserResouce;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Class constructor.
     */
    public function __construct(
        private AuthService $authService
    ) {
        $this->middleware(['auth:sanctum'])->only('destroy');
    }

    public function store(AuthLoginRequest $request)
    {
        $request_data = $request->validated();
        return $this->authService->createLogin(['email' => $request_data['email'], 'password' => $request_data['password']]);
    }
    public function destroy()
    {
        return $this->authService->deleteSession();
    }

    public function notifyForgotPassword(ForgotPasswordRequest $request)
    {
        $request_data = $request->validated();
        return $this->authService->notifyForgotPassword($request_data['email']);
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $request_data = $request->validated();
        return $this->authService->resetPassword($request_data);
    }
}

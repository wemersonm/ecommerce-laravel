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
        $input = $request->validated();
        return $this->authService->createLogin(['email' => $input['email'], 'password' => $input['password']]);

    }
    public function destroy()
    {
        return $this->authService->deleteSession();
    }

    public function register(UserRegisterRequest $request)
    {
        $requestData = $request->validated();
        return $this->authService->createUser($requestData);

    }

    public function forgotPassword(ForgotPasswordRequest $request)
    {
        $requestData = $request->validated();
        return $this->authService->forgotPassword($requestData['email']);
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $requestData = $request->validated();
        return $this->authService->resetPassword($requestData);
    }



}

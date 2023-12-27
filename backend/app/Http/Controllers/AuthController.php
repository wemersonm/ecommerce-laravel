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
        $autorization = $this->authService->createLogin(['email' => $input['email'], 'password' => $input['password']]);
        return (new UserResouce(auth()->user()))->additional(['authorization' => $autorization]);
    }
    public function destroy()
    {
        $deleted = auth()->user()->currentAccessToken()->delete();
        return response()->json($deleted, 200);
    }

    public function register(UserRegisterRequest $request)
    {
        $requestData = $request->validated();
        $authorization = $this->authService->createUser($requestData);
        return (new UserResouce(auth()->user()))->additional(['authorization' => $authorization]);
    }

    public function forgotPassword(ForgotPasswordRequest $request)
    {
        $requestData = $request->validated();
        $this->authService->forgotPassword($requestData['email']);
        return response(null, 200);
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        try {
            $requestData = $request->validated();
        } catch (ValidationException $e) {
            return $e->getMessage();
        }
        $this->authService->resetPassword($requestData);
        return response(null, 200);
    }



}

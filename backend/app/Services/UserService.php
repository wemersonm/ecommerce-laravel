<?php

namespace App\Services;

use Throwable;
use App\Http\Resources\UserResouce;
use App\Jobs\SendEmailRegisteredJob;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Exceptions\EmailAlreadyExistExeception;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UserService
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
    ) {
    }

    public function userRegistration(array $request_data)
    {
        try {
            $email_exist = $this->userRepository->emailExist($request_data['email']);
            if ($email_exist)
                throw new EmailAlreadyExistExeception();

            $user = $this->userRepository->createUser($request_data);
            Auth::login($user);
            /** @var \App\Models\User $user */
            $user = auth()->user();
            SendEmailRegisteredJob::dispatch($user)->onQueue('user-data');
            $token = $user->createToken('auth')->plainTextToken;
            $cookie = Cookie::forever('user_token', $token, sameSite: 'Strict');
            return response()->json([
                'success' => true,
                'data' => new UserResouce($user),
                'token' => [
                    'access_token' => $token,
                    'expires' => now()->addMinutes(config('sanctum.expiration')),
                ],
                'message' => 'user athenticated with success',
            ], 201)->cookie($cookie);
        } catch (Throwable $th) {
            return $this->responseError($th, 'error when registering in the system');
        }
    }
    public function responseError($th, string $message = "", $data = [])
    {
        $code =
            $th instanceof HttpException ?
            $th->getStatusCode() : ($th->statusCode ?? 500);
        return response()->json([
            'error' => class_basename($th),
            'message' => $message ? $message : $th->getMessage(),
            'data' => $data,
        ], $code ?? 500);
    }
}

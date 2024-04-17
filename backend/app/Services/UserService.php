<?php

namespace App\Services;

use Throwable;
use App\Http\Resources\UserResouce;
use App\Jobs\SendEmailRegisteredJob;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Exceptions\EmailAlreadyExistExeception;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Traits\ResponseService;

class UserService
{
    use ResponseService;

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
            return $this->responseSuccess([
                'data' => new UserResouce($user),
                'token' => [
                    'access_token' => $token,
                    'expires' => now()->addMinutes(config('sanctum.expiration')),
                ],
                'message' => 'user athenticated with success',
            ], 201, $cookie);
        } catch (Throwable $th) {
            return $this->responseError($th, 'error when registering in the system');
        }
    }
}

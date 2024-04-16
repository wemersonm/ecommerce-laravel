<?php

namespace App\Services;

use Throwable;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\ResetPassword;
use App\Events\ForgotPassword;
use App\Events\UserRegistered;
use App\Http\Resources\UserResouce;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Exceptions\LoginInvalidException;
use App\Exceptions\UserNotExistsException;
use App\Exceptions\EmailNotExistsException;
use App\Exceptions\EmailAlreadyExistExeception;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Exceptions\CredentialsInvalidResetTokenException;

class AuthService
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
    ) {
    }

    public function userRegistration(array $request_data)
    {
        try {
            /** @var \App\Models\User $user */
            $email_exist = $this->userRepository->emailExist($request_data['email']);
            if ($email_exist)
                throw new EmailAlreadyExistExeception();

            $user = $this->userRepository->createUser($request_data);
            Auth::login($user);
            $user = auth()->user();
            // event(new UserRegistered($user));
            $authorization = array(
                'token' => auth()->user()->createToken('auth')->plainTextToken,
                'type' => 'Bearer',
            );
            // return (new UserResouce($user))->additional(
            //     ['authorization' => $authorization,]
            // );
        } catch (Throwable $th) {
            // return $this->responseError($th, 'error when registering in the system');

        }
    }
}

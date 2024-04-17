<?php

namespace App\Services;

use Throwable;
use App\Exceptions\ErrorSystem;
use App\Traits\ResponseService;
use App\Http\Resources\UserResouce;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Exceptions\LoginInvalidException;
use App\Exceptions\EmailNotExistsException;
use App\Jobs\SendNotificationResetPasswordJob;
use App\Exceptions\TokenValidationInvalidException;
use App\Repositories\Interfaces\UserRepositoryInterface;

class AuthService
{
    use ResponseService;

    public function __construct(
        private UserRepositoryInterface $userRepository,
    ) {
    }
    public function createLogin(array $data)
    {
        try {
            $auth = Auth::attempt($data);
            if (!$auth) {
                throw new LoginInvalidException();
            }
            $user = auth()->user();
            $token = $user->createToken('auth')->plainTextToken;
            $cookie = Cookie::forever('user_token', $token, sameSite: 'Strict');

            return $this->responseSuccess([
                'data' => new UserResouce($user),
                'token' => [
                    'access_token' => $token,
                    'expires' => now()->addMinutes(config('sanctum.expiration')),
                ],
                'message' => 'user athenticated with success',
            ], 200, $cookie);
        } catch (Throwable $th) {
            return $this->responseError($th, 'error when authenticate user');
        }
    }

    public function notifyForgotPassword(string $email)
    {
        try {
            $email_exist = $this->userRepository->emailExist($email, true);
            if (!$email_exist) {
                throw new EmailNotExistsException();
            }
            $this->userRepository->deleteAllPasswordResetToken($email_exist->email, 'HASH');
            $token = $this->userRepository->createPasswordResetToken($email, 'HASH');
            SendNotificationResetPasswordJob::dispatch($email_exist, $token->token, ['mail'])->onQueue('user-data');
            return $this->responseSuccess(['message' => 'notification reset password sent successfully'], 200);
        } catch (Throwable $th) {
            return $this->responseError($th, 'error when send notification recover password');
        }
    }
    public function resetPassword(array $request_data)
    {
        try {
            $password_reset_token_valid =
                $this->userRepository->validatePasswordResetToken($request_data['email'], $request_data['token']);
            if (!$password_reset_token_valid) {
                throw new TokenValidationInvalidException;
            }
            $password_updated = $this->userRepository->updatePassword(
                $password_reset_token_valid->email,
                $request_data['password']
            );
            $password_updated ? $tokens_deleted = $this->userRepository->deleteAllPasswordResetToken($password_reset_token_valid->email, 'HASH') : throw new ErrorSystem('erro when update password');
            return $this->responseSuccess(['message' => 'password updated with success'], 200);
        } catch (Throwable $th) {
            return $this->responseError($th, 'erro when reset password');
        }
    }
    public function deleteSession()
    {
        try {
            $user = auth()->user();
            $user->currentAccessToken()->delete();
            return $this->responseSuccess(['message' => 'session user destroyed'], 200);
        } catch (Throwable $th) {
            return $this->responseError($th, 'user session destroyed with success');
        }
    }
}

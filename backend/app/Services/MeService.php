<?php

namespace App\Services;

use Throwable;
use App\Exceptions\ErrorSystem;
use App\Http\Resources\UserResouce;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use App\Exceptions\PasswordInvalidException;
use App\Exceptions\EmailAlreadyExistExeception;
use App\Exceptions\TokenValidationInvalidException;
use App\Jobs\SendNotificationChangeEmailJob;
use App\Jobs\SendNotificationChangePasswordJob;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;

class MeService
{

    public function __construct(
        private UserRepositoryInterface $userRepository,
    ) {
    }
    public function getUserAuthenticate()
    {
        try {
            $authorization = array(
                'auth' => true,
                'token' => request()->bearerToken(),
                'type' => 'Bearer',
            );
            $user = auth()->user();
            $cookie = Cookie::forever('user_token', $authorization['token'], '/', '', true, true, false, 'strict');
            return $this->responseSuccess(['data' => ['name' => $user->name, 'email' => $user->email], 'authorization' => $authorization], 200)->cookie($cookie);
        } catch (Throwable $th) {
            return $this->responseError($th, 'error when getting authenticated user');
        }
    }
    public function confirmPassword(string $password)
    {
        try {
            $user_password = auth()->user()->password;
            if (!Hash::check($password, $user_password)) {
                throw new PasswordInvalidException();
            }
            return $this->responseSuccess(['auth' => true, 'message' => 'password is valid'], 200);
        } catch (Throwable $th) {
            return $this->responseError($th, 'error at confirm password');
        }
    }
    public function notifyChangePassword()
    {
        try {
            $user = auth()->user();
            $this->userRepository->deleteAllPasswordResetToken($user->email);
            $password_reset_token = $this->userRepository->createPasswordResetToken($user->email);
            SendNotificationChangePasswordJob::dispatch($user, $password_reset_token, ['mail'])->onQueue('user-data-change');
            return $this->responseSuccess(['message' => 'code sent with success', 'send_to' => $user->email], 200);
        } catch (Throwable $th) {
            return $this->responseError($th, 'error at send notification of change password');
        }
    }
    public function changePassword(array $request_data)
    {
        try {
            $user = auth()->user();
            $password_reset_token_valid = $this->userRepository->validatePasswordResetToken($user->email, $request_data['token']);
            !$password_reset_token_valid ? throw new TokenValidationInvalidException() : null;
            !Hash::check($request_data['current_password'], $user->password) ? throw new PasswordInvalidException() : null;
            $password_updated = $this->userRepository->updatePassword($user->email, $request_data['new_password']);
            $password_updated == 1 ?
                $this->userRepository->deleteAllPasswordResetToken($user->email) : throw new ErrorSystem();
            return $this->responseSuccess(['message' => 'password updated with success'], 200);
        } catch (Throwable $th) {
            return $this->responseError($th, 'error at change password');
        }
    }
    public function editUser(array $request_data)
    {
        try {
            $user = auth()->user();
            $user_updated = $this->userRepository->updateDataUser($user->email, $request_data);
            return $this->responseSuccess(['data' => new UserResouce($user_updated)], 200);
        } catch (Throwable $th) {
            return $this->responseError($th, 'error at edit user');
        }
    }

    public function notifyChangeEmail()
    {
        try {
            $user = auth()->user();
            $this->userRepository->deleteAllEmailResetToken($user->email);
            $email_reset_token = $this->userRepository->createEmailResetToken($user->email);
            SendNotificationChangeEmailJob::dispatch($user, $email_reset_token->token, ['mail'])->onQueue('user-data-change');
            return $this->responseSuccess(['message' => 'code sent with success', 'send_to' => $user->email], 200);
        } catch (Throwable $th) {
            return $this->responseError($th, 'error when sent notification change email');
        }
    }
    public function changeEmail(array $request_data)
    {
        try {
            $user = auth()->user();
            $email_reset_token_valid = $this->userRepository->validateEmailResetToken($user->email, $request_data['token']);
            !$email_reset_token_valid ? throw new TokenValidationInvalidException() : null;
            !Hash::check($request_data['password'], $user->password) ? throw new PasswordInvalidException() : null;
            $user_email = $user->email;
            $user_email == $request_data['new_email'] || $this->userRepository->verifyExistEmail($request_data['new_email']) ?
                throw new EmailAlreadyExistExeception : null;
            $user_email_updated = $this->userRepository->updateEmail($user_email, $request_data['new_email']);
            !$user_email_updated ? throw new ErrorSystem : null;
            $this->userRepository->deleteAllEmailResetToken($email_reset_token_valid->email);
            return $this->responseSuccess(['message' => 'password changed successfully'], 200);
        } catch (Throwable $th) {
            return $this->responseError($th, 'error at change email');
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

    public function responseSuccess(array $data, int $code)
    {
        return response()->json(array_merge(['success' => true], $data), $code);
    }
}

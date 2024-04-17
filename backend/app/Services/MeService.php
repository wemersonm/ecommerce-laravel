<?php

namespace App\Services;

use Throwable;
use App\Exceptions\ErrorSystem;
use App\Http\Resources\UserResouce;
use Illuminate\Support\Facades\Hash;
use App\Exceptions\PasswordInvalidException;
use App\Exceptions\EmailAlreadyExistExeception;
use App\Exceptions\TokenValidationInvalidException;
use App\Jobs\SendNotificationChangeEmailJob;
use App\Jobs\SendNotificationChangePasswordJob;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Traits\ResponseService;

class MeService
{
    use ResponseService;

    public function __construct(
        private UserRepositoryInterface $userRepository,
    ) {
    }
    public function getUserAuthenticate()
    {
        try {
            $user = auth()->user();
            return $this->responseSuccess(
                [
                    'data' => new UserResouce($user),
                ],
                200
            );
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
            return $this->responseSuccess(['message' => 'password is valid'], 200);
        } catch (Throwable $th) {
            return $this->responseError($th, 'error at confirm password');
        }
    }
    public function notifyChangePassword()
    {
        try {
            $user = auth()->user();
            $this->userRepository->deleteAllPasswordResetToken($user->email, 'NUMERIC');
            $password_reset_token = $this->userRepository->createPasswordResetToken($user->email, 'NUMERIC');
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
                $this->userRepository->deleteAllPasswordResetToken($user->email, 'NUMERIC') : throw new ErrorSystem();
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
            $this->userRepository->deleteAllEmailResetToken($user->email, 'NUMERIC');
            $email_reset_token = $this->userRepository->createEmailResetToken($user->email, 'NUMERIC');
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
            $this->userRepository->deleteAllEmailResetToken($email_reset_token_valid->email, 'NUMERIC');
            return $this->responseSuccess(['message' => 'password changed successfully'], 200);
        } catch (Throwable $th) {
            return $this->responseError($th, 'error at change email');
        }
    }
}

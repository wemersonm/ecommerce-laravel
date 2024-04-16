<?php

namespace App\Services;

use Throwable;
use Illuminate\Support\Str;
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
    public function createLogin(array $data)
    {
        try {
            $auth = Auth::attempt($data);
            if (!$auth) {
                throw new LoginInvalidException();
            }
            $authorization = array(
                'token' => auth()->user()->createToken('auth')->plainTextToken,
                'type' => 'Bearer',
            );
            return (new UserResouce(auth()->user()))->additional(['authorization' => $authorization]);
        } catch (Throwable $th) {
            return $this->responseError(class_basename($th), $th->getMessage(), $th->statusCode ?? 400); // phpcs:ignore

        }
    }

    public function createUser(array $data)
    {
        try {
            $userExist = $this->userRepository->emailExist($data['email']);
            if ($userExist)
                throw new EmailAlreadyExistExeception();

            $userCreated = $this->userRepository->createUser($data);
            /** @var \App\Models\User $user */
            Auth::login($userCreated);
            $user = auth()->user();
            event(new UserRegistered($user));
            $authorization = array(
                'token' => auth()->user()->createToken('auth')->plainTextToken,
                'type' => 'Bearer',
            );
            return (new UserResouce($user))->additional(
                ['authorization' => $authorization,]
            );
        } catch (Throwable $th) {
            return $this->responseError(class_basename($th), $th->getMessage(), $th->statusCode ?? 400); // phpcs:ignore

        }
    }
    public function forgotPassword(string $email)
    {
        try {
            $emailExist = $this->userRepository->emailExist($email);
            if (!$emailExist) {
                throw new EmailNotExistsException();
            }
            $token = $this->userRepository->createPasswordReset([
                'email' => $email,
                'token' => Str::random(120),
            ]);
            event(new ForgotPassword($emailExist, $token['token']));
            return response()->json(['success' => true, 'message' => 'email sent for user'], 200);
        } catch (Throwable $th) {
            return $this->responseError(class_basename($th), $th->getMessage(), $th->statusCode ?? 400); // phpcs:ignore
        }
    }
    public function resetPassword(array $data)
    {
        try {
            $tokenExist = $this->userRepository->validateTokenPasswordReset($data['email'], $data['password']);
            if (!$tokenExist) {
                throw new CredentialsInvalidResetTokenException();
            }
            $user = $this->userRepository->emailExist($data['email']);
            if (!$user) {
                throw new UserNotExistsException();
            }
            $updated = $this->userRepository->updateUser($user, ['password' => Hash::make($data['password'])]);

            $deleted = $this->userRepository->deletePasswordReset($tokenExist->id);

            return $updated && $deleted ?
                response()->json(['success' => true, 'message' => 'password reseted sucessfully']) :
                response()->json(['success' => false, 'message' => 'error at update password and delete token'], 400);
        } catch (Throwable $th) {
            return $this->responseError(class_basename($th), $th->getMessage(), $th->statusCode ?? 400); // phpcs:ignore
        }
    }

    public function deleteSession()
    {
        try {
            $deleted = auth()->user()->currentAccessToken()->delete();
            return response()->json([
                'success' => (bool) $deleted,
                'message' => 'token deleted with successfully'
            ], 200);
        } catch (Throwable $th) {
            return $this->responseError(class_basename($th), $th->getMessage(), $th->statusCode ?? 400); // phpcs:ignore

        }
    }

    public function responseError(string $error, string $message, int $code = 400, $data = [])
    {
        return response()->json([
            'error' => $error,
            'message' => $message,
            'data' => $data,
        ], $code);
    }
}

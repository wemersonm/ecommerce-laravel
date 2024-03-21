<?php

namespace App\Services;

use App\Events\ChangeEmail;
use App\Exceptions\EmailAlreadyExistExeception;
use App\Exceptions\EmailSameRegisteredException;
use App\Exceptions\TokenOrEmailChangeEmailInvalidException;
use Throwable;
use App\Http\Resources\UserResouce;
use Illuminate\Support\Facades\Hash;
use App\Exceptions\PasswordInvalidException;
use App\Exceptions\CurrentPasswordInvalidException;
use App\Repositories\Interfaces\UserRepositoryInterface;

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
        'token' => request()->bearerToken(),
        'type' => 'Bearer',
      );
      return (new UserResouce(auth()->user()))->additional(['authorization' => $authorization]);
    } catch (Throwable $th) {
      return $this->responseError(class_basename($th), $th->getMessage(), $th->statusCode ?? 400); // phpcs:ignore
    }
  }

  public function confirmPassord(string $password)
  {
    try {
      $user_password = request()->user()->password;
      if (!Hash::check($password, $user_password)) {
        throw new PasswordInvalidException();
      }
      return response()->json(['valid' => true]);
    } catch (Throwable $th) {
      return $this->responseError(class_basename($th), $th->getMessage(), $th->statusCode ?? 400); // phpcs:ignore

    }
  }

  public function changePassword(array $data)
  {
    try {
      $user = auth()->user();
      if (!Hash::check($data['current_password'], $user->password)) {
        throw new CurrentPasswordInvalidException();
      }
      $user->password = Hash::make($data['new_password']);
      $user->save();
      return new UserResouce($user);
    } catch (Throwable $th) {
      return $this->responseError(class_basename($th), $th->getMessage(), $th->statusCode ?? 400); // phpcs:ignore

    }
  }

  public function editProfile(array $data)
  {
    try {
      /** @var \App\Models\User $user */
      $user = auth()->user();
      $updated = $this->userRepository->updateUser($user, $data);
      return new UserResouce($updated);
    } catch (Throwable $th) {
      return $this->responseError(class_basename($th), $th->getMessage(), $th->statusCode ?? 400); // phpcs:ignore
    }
  }
  public function changeEmail(string $new_email)
  {
    try {
      $user = auth()->user();
      $userEmail = $user->email;
      if ($userEmail == $new_email) {
        throw new EmailSameRegisteredException;
      }
      if ($this->userRepository->emailExist($new_email)) {
        throw new EmailAlreadyExistExeception;
      }

      $email_reset = $this->userRepository->createEmailReset($user->email);
      event(new ChangeEmail($user, $email_reset->token));
      return response()->json([
        'success' => true,
        'message' => 'email send successfully',
      ], 200);
    } catch (Throwable $th) {
      return $this->responseError(class_basename($th), $th->getMessage(), $th->statusCode ?? 400); // phpcs:ignore
    }

  }
  public function confirmChangeEmail(array $data)
  {
    try {
      $token_is_valid = $this->userRepository->validateToken($data['token'], $data['email']);
      if (!$token_is_valid)
        throw new TokenOrEmailChangeEmailInvalidException;

      if ($this->userRepository->emailExist($data['email'])) {
        throw new EmailAlreadyExistExeception;
      }
      $updated = $this->editProfile(['email' => $data['email']]);

      return response()->json([
        'success' => true,
        'message' => 'email updated successfully'
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

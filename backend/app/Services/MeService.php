<?php

namespace App\Services;

use App\Exceptions\DiscountCuponAlreadyAppliedExcepion;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;
use App\Events\ChangeEmail;
use App\Http\Resources\UserResouce;
use Illuminate\Support\Facades\Hash;
use App\Exceptions\PasswordInvalidException;
use App\Exceptions\EmailAlreadyExistExeception;
use App\Exceptions\EmailSameRegisteredException;
use App\Exceptions\CurrentPasswordInvalidException;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Exceptions\TokenOrEmailChangeEmailInvalidException;

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
      $cookie = cookie('USR_LG',)
      return (new UserResouce(auth()->user()))->additional(['authorization' => $authorization]);
    } catch (Throwable $th) {
      return $this->responseError($th, 'error at get user');
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
      return $this->responseError($th, 'error at confirm password');
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
      return $this->responseError($th, 'error at change password');

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
      return $this->responseError($th, 'error at edit user');

    }
  }
  public function changeEmail(string $new_email, string $password)
  {
    try {
      $user = auth()->user();

      if (!Hash::check($password, $user->password)) {
        throw new PasswordInvalidException();
      }
      $userEmail = $user->email;
      if ($userEmail == $new_email) {
        throw new EmailSameRegisteredException;
      }
      if ($this->userRepository->emailExist($new_email)) {
        throw new EmailAlreadyExistExeception;
      }
      $email_reset_instance = $this->userRepository->createEmailReset($userEmail, $new_email, rand(100000, 999999));
      event(new ChangeEmail($user, $email_reset_instance->token));
      return response()->json([
        'success' => true,
        'message' => 'email send successfully',
      ], 200);
    } catch (Throwable $th) {
      return $this->responseError($th, 'error at change email');

    }
  }
  public function confirmChangeEmail(string $token)
  {
    try {
      $user = auth()->user();
      $token_is_valid = $this->userRepository->validateToken($token, $user->email);
      if (!$token_is_valid)
        throw new TokenOrEmailChangeEmailInvalidException;

      if ($this->userRepository->emailExist($token_is_valid['new_email'])) {
        throw new EmailAlreadyExistExeception;
      }
      $updated = $this->editProfile(['email' => $token_is_valid['new_email']]);
      // updated ? desabilitar o token de mudar senha.
      return response()->json([
        'success' => true,
        'message' => 'email updated successfully'
      ], 200);

    } catch (Throwable $th) {
      return $this->responseError($th, 'error at confirm change email');
    }
  }
  public function responseError($th, string $message = "", $data = [])
  {
    $code =
      $th instanceof HttpException ?
      $th->getStatusCode() :
      ($th->statusCode ?? 500);
    return response()->json([
      'error' => class_basename($th),
      'message' => !empty($th->getMessage()) ? $th->getMessage() : $message,
      'data' => $data,
    ], $code ?? 500);
  }
}

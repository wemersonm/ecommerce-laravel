<?php

namespace App\Services;

use App\Events\ForgotPassword;
use App\Events\UserRegistered;
use App\Exceptions\CredentialsInvalidResetTokenException;
use App\Exceptions\EmailAlreadyExistExeception;
use App\Exceptions\EmailNotExistsException;
use App\Exceptions\LoginInvalidException;
use App\Exceptions\UserNotExistsException;
use App\Models\ResetPassword;
use App\Models\User;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Sanctum\PersonalAccessToken;

class AuthService
{

  public function createLogin(array $data)
  {
    $auth = Auth::attempt($data);
    if (!$auth) {
      throw new LoginInvalidException();
    }
    $authorization = array(
      'token' => auth()->user()->createToken('auth')->plainTextToken,
      'type' => 'Bearer',
    );
    return $authorization;
  }

  public function createUser(array $data)
  {

    $userExist = User::where('email', $data['email'])->first();
    if ($userExist)
      throw new EmailAlreadyExistExeception();

    $userCreated = User::create([
      'name' => $data['name'],
      'email' => $data['email'],
      'password' => $data['password'],
    ]);

    /** @var \App\Models\User $user */
    Auth::login($userCreated);
    $user = auth()->user();
    event(new UserRegistered($user));

    $token = auth()->user()->createToken('auth')->plainTextToken;

    return array(
      'token' => $token,
      'type' => 'Bearer',
    );
  }

  public function forgotPassword(string $email)
  {
    try {
      $emailExist = User::where('email', $email)->first();
      if (!$emailExist) {
        throw new EmailNotExistsException();
      }
      $token = ResetPassword::create([
        'email' => $email,
        'token' => Str::random(75),
      ]);
      event(new ForgotPassword($emailExist, $token['token']));
    } catch (\Exception $e) {
      dd($e->getMessage());
    }
  }
  public function resetPassword(array $data)
  {
    $tokenExist = ResetPassword::where('email', $data['email'])->where('token', $data['token'])->first();
    if (!$tokenExist) {
      throw new CredentialsInvalidResetTokenException();
    }
    $user = User::where('email', $data['email'])->first();
    if (!$user) {
      throw new UserNotExistsException();
    }
    $user->password = bcrypt($data['password']);
    $user->save();

    $tokenExist->delete();

  }


}

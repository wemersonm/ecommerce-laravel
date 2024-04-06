<?php

namespace App\Repositories\Eloquent;

use App\Models\ResetPassword;
use App\Models\User;
use App\Models\ResetEmail;
use Illuminate\Support\Str;
use App\Repositories\Interfaces\UserRepositoryInterface;

class EloquentUserRepository implements UserRepositoryInterface
{

  public function updateUser(User $user, array $data)
  {
    $user->fill($data);
    $updated = $user->save();
    return $updated ? $user : null;
  }
  public function createEmailReset(string $email, string $new_email, string $token)
  {
    return ResetEmail::create(
      [
        'current_email' => $email,
        'new_email' => $new_email,
        'token' => $token,
      ]
    );
  }
  public function emailExist(string $new_email)
  {
    return User::where('email', $new_email)->first();
  }

  public function validateToken(string $token, string $current_email)
  {
    $token = ResetEmail::where('token', $token)->where('current_email', $current_email)->first();
    return $token;
  }


  public function createUser(array $data)
  {
    return User::create($data);
  }

  public function createPasswordReset(array $data)
  {
    return ResetPassword::create($data);
  }

  public function validateTokenPasswordReset(string $email, string $token)
  {
    return ResetPassword::where('email', $email)->where('token', $token)->first();
  }
  public function deletePasswordReset(int $id)
  {
    return ResetPassword::destroy($id);
  }


}

<?php

namespace App\Repositories\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{
  public function updateUser(User $user, array $data);
  public function createEmailReset(string $new_email);
  public function emailExist(string $new_email);
  public function validateToken(string $token,string $new_email);


}

<?php

namespace App\Repositories\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{
  public function updateUser(User $user, array $data);
  public function createEmailReset(string $new_email);
  public function emailExist(string $new_email);
  public function validateToken(string $token, string $new_email);

  public function createUser(array $data);

  public function createPasswordReset(array $data);
  public function validateTokenPasswordReset(string $email, string $token);
  public function deletePasswordReset(int $id);



}

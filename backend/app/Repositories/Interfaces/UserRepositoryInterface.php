<?php

namespace App\Repositories\Interfaces;

use App\Models\ResetEmail;
use App\Models\ResetPassword;
use App\Models\User;

interface UserRepositoryInterface
{
  // public function updateUser(User $user, array $data);
  public function createEmailReset(string $email, string $new_email, string $token);
  public function emailExist(string $new_email);
  public function validateToken(string $token, string $current_email);

  public function createUser(array $data);

  public function validateTokenPasswordReset(string $email, string $token);
  public function deletePasswordReset(int $id);


  // refactpor ....

  public function createPasswordResetToken(string $email): ResetPassword;

  public function validatePasswordResetToken(string $email, string $token): ResetPassword|null;

  public function updatePassword(string $email, string $password): int;
 
  public function deletePasswordResetToken(int $id): int;
  public function deleteAllPasswordResetToken(string $email): int;
  public function updateDataUser(string $email, array $user_data): User;
  public function verifyExistEmail(string $email): bool;
  public function createEmailResetToken(string $email): ResetEmail;
  public function validateEmailResetToken(string $email, string $token): ResetEmail|null;
  public function updateEmail(string $email, string $new_email): int;
  public function deleteEmailResetToken(int $id): int;
  public function deleteAllEmailResetToken(string $email): int;
}

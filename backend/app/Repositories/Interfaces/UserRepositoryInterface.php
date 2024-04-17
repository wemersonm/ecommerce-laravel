<?php

namespace App\Repositories\Interfaces;

use App\Models\ResetEmail;
use App\Models\ResetPassword;
use App\Models\User;

interface UserRepositoryInterface
{
    public function emailExist(string $email, bool $model = false): bool|User;
    public function createUser(array $data): User;
    public function createPasswordResetToken(string $email, string|int $type): ResetPassword;
    public function validatePasswordResetToken(string $email, string $token): ResetPassword|null;
    public function updatePassword(string $email, string $password): int;
    public function deletePasswordResetToken(int $id): int;
    public function deleteAllPasswordResetToken(string $email, string|int $type): int;
    public function updateDataUser(string $email, array $user_data): User;
    public function verifyExistEmail(string $email): bool;
    public function createEmailResetToken(string $email, string|int $type): ResetEmail;
    public function validateEmailResetToken(string $email, string $token): ResetEmail|null;
    public function updateEmail(string $email, string $new_email): int;
    public function deleteEmailResetToken(int $id): int;
    public function deleteAllEmailResetToken(string $email, string|int $type): int;
}

<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Models\ResetEmail;
use Illuminate\Support\Str;
use App\Models\ResetPassword;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Interfaces\UserRepositoryInterface;

class EloquentUserRepository implements UserRepositoryInterface
{
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


    public function validateToken(string $token, string $current_email)
    {
        $token = ResetEmail::where('token', $token)->where('current_email', $current_email)->first();
        return $token;
    }






    public function validateTokenPasswordReset(string $email, string $token)
    {
        return ResetPassword::where('email', $email)->where('token', $token)->first();
    }
    public function deletePasswordReset(int $id)
    {
        return ResetPassword::destroy($id);
    }


    // .. refactor

    public function emailExist(string $new_email): bool
    {
        return User::where('email', $new_email)->exists();
    }


    public function createUser(array $data): User
    {
        return User::create($data);
    }

    public function createPasswordResetToken(string $email): ResetPassword
    {
        return ResetPassword::create([
            'email' => $email,
            'token' => rand(100000, 999999),
        ]);
    }
    public function validatePasswordResetToken(string $email, string $token): ResetPassword|null
    {
        return ResetPassword::where('email', $email)->where('token', $token)->first();
    }

    public function updatePassword(string $email, string $password): int
    {
        return User::where('email', $email)->update(['password' => Hash::make($password)]);
    }

    public function deletePasswordResetToken(int $id): int
    {
        return ResetPassword::destroy($id);
    }
    public function deleteAllPasswordResetToken(string $email): int
    {
        return ResetPassword::where('email', $email)->delete();
    }

    public function updateDataUser(string $email, array $user_data): User
    {
        $user = User::where('email', $email)->first();
        $user->fill($user_data);
        $user->save();
        return $user;
    }

    public function createEmailResetToken(string $email): ResetEmail
    {
        return ResetEmail::create(['email' => $email, 'token' => rand(100000, 999999)]);
    }
    public function verifyExistEmail(string $email): bool
    {
        return User::where('email', $email)->exists();
    }

    public function validateEmailResetToken(string $email, string $token): ResetEmail|null
    {
        return ResetEmail::where('email', $email)->where('token', $token)->first();
    }
    public function updateEmail(string $email, string $new_email): int
    {
        return User::where('email', $email)->update(['email' => $new_email]);
    }

    public function deleteEmailResetToken(int $id): int
    {
        return ResetEmail::destroy($id);
    }
    public function deleteAllEmailResetToken(string $email): int
    {
        return ResetEmail::where('email', $email)->delete();
    }
}

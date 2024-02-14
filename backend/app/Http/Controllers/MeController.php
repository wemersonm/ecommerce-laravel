<?php

namespace App\Http\Controllers;

use App\Exceptions\CurrentPasswordInvalidException;
use App\Exceptions\PasswordInvalidException;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\EditProfileRequest;
use App\Http\Resources\UserResouce;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class MeController extends Controller
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        $this->middleware("auth:sanctum");
    }

    public function index()
    {
        $authorization = array(
            'token' => request()->bearerToken(),
            'type' => 'Bearer',
        );
        return (new UserResouce(auth()->user()))->additional(['authorization' => $authorization]);
    }

    public function confirmPassword(Request $request)
    {
        $userPass = request()->user()->password;
        if (!Hash::check($request->password, $userPass)) {
            throw new PasswordInvalidException();
        }
        return response()->json(['valid' => true]);
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $data = $request->validated();
        $user = auth()->user();

        if (!Hash::check($data['current_password'], $user->password)) {
            throw new CurrentPasswordInvalidException();
        }
        $user->password = $data['new_password'];
        $user->save();
        return $user->fresh();
    }

    public function editProfile(EditProfileRequest $request)
    {
        $data = $request->validated();
        $user = auth()->user();
        $updated = $user->update($data);
        return $updated ? $user : throw new \Exception('error at update user');
    }

    public function changeEmail(Request $request)
    {
        $validation = $request->validate([
            'new_email' => ['required', 'email'],
        ]);
        $userEmail = auth()->user()->email;
        if ($userEmail !== $validation['new_email']) {
            // envar evento para mandar um email cadastrado para confirmar a alteração;
        }
        // retorna nada 

    }

}

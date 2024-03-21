<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\EditProfileRequest;
use App\Services\MeService;
use Illuminate\Http\Request;

class MeController extends Controller
{
    /**
     * Class constructor.
     */
    public function __construct(
        private MeService $meService,
    ) {
        $this->middleware("auth:sanctum");
    }

    public function index()
    {
        return $this->meService->getUserAuthenticate();
    }

    public function confirmPassword(Request $request)
    {
        $data = $request->validate(['password' => ['required']]);
        return $this->meService->confirmPassord($data['password']);
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $data = $request->validated();
        return $this->meService->changePassword($data);
    }

    public function edit(EditProfileRequest $request)
    {
        $data = $request->validated();
        return $this->meService->editProfile($data);
    }

    public function changeEmail(Request $request)
    {
        $data = $request->validate([
            'new_email' => ['required', 'email', 'confirmed'],
        ]);
        dd($data);
        return $this->meService->changeEmail($data['new_email']);
    }
    public function confirmChangeEmail(Request $request)
    {
        $data = $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
        ]);
        return $this->meService->confirmChangeEmail($data);
    }
}

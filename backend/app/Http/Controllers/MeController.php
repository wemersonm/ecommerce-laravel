<?php

namespace App\Http\Controllers;

use App\Http\Requests\changeEmailRequest;
use App\Services\MeService;
use Illuminate\Http\Request;
use App\Http\Requests\EditProfileRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\NotifyChangePasswordRequest;

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
        return $this->meService->confirmPassword($data['password']);
    }

    public function notifyChangePassword()
    {
        return $this->meService->notifyChangePassword();
    }
    public function changePassword(ChangePasswordRequest $request)
    {
        $data = $request->validated();
        return $this->meService->changePassword($data);
    }
    public function edit(EditProfileRequest $request)
    {
        $request_data = $request->validated();
        return $this->meService->editUser($request_data);
    }

    public function notifyChangeEmail()
    {
        return $this->meService->notifyChangeEmail();
    }
    public function changeEmail(changeEmailRequest $request)
    {
        $request_data = $request->validated();
        return $this->meService->changeEmail($request_data);
    }
    public function confirmChangeEmail(Request $request)
    {
        $data = $request->validate([
            'token' => ['required'],
        ]);
        return $this->meService->confirmChangeEmail($data['token']);
    }
}

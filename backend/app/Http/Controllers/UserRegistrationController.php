<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegistrationRequest;

class UserRegistrationController extends Controller
{
    public function __construct(
        private UserService $userService,
    ) {
        $this->middleware("guest");
    }

    public function store(UserRegistrationRequest $request)
    {
        $request_data = $request->validated();
        return $this->userService->userRegistration($request_data);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResouce;
use Illuminate\Http\Request;
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

   
}

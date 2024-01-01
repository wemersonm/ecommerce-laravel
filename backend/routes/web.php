<?php

use App\Mail\ResetPasswordEmail;
use App\Models\ResetPassword;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {

  try {
    $user = User::find(1);
    Mail::to($user)->queue(new ResetPasswordEmail($user, 'eo1533'));
  } catch (\Throwable $th) {
    return $th->getMessage();
  }
  return 'mandado';

});

<?php

use App\Models\ResetPassword;
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
  $data = '2023-12-25 23:51:22';
  $carbon = Carbon::parse($data);
  return ($carbon)->diffInHours();


/*   return now();
  $createdAndTreeDays = (ResetPassword::first()->created_at)->addDays(1)->subHours(3);
  return (now()->subHours(3))->greaterThan($createdAndTreeDays) ? "Sim" : "Não"; */

});

<?php

use App\Repositories\Eloquent\EloquentCartRepository;
use App\Services\CartService;
use Illuminate\Support\Facades\Auth;
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
    $user = Auth::attempt(['email' => 'admin@email.com', 'password' => 'asasasas']);

    $interface = new EloquentCartRepository();
    $cartService = new CartService($interface);
    $data = $cartService->serviceGetProductsInCart();
    return view('teste')->with(['data' => $data]);
  } catch (Throwable $th) {
    dd($th);
  }



});

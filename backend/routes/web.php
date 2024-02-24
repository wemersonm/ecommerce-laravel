<?php

use App\Repositories\Eloquent\EloquentCartRepository;
use App\Repositories\Eloquent\EloquentProductRepository;
use App\Services\CartService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Stavarengo\Sigep\Client;

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

 

  /* try {
    $user = Auth::attempt(['email' => 'admin@email.com', 'password' => 'asasasas']);

    $interface = new EloquentCartRepository();
    $interface2 = new EloquentProductRepository();
    $cartService = new CartService($interface,$interface2);
    $data = $cartService->serviceGetProductsInCart();
    return view('teste')->with(['data' => $data]);
  } catch (Throwable $th) {
    dd($th);
  } */



});

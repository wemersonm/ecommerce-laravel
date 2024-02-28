<?php

use App\Events\UserRegistered;
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



  // try {

  //   $interface = new EloquentCartRepository();
  //   $interface2 = new EloquentProductRepository();
  //   $cartService = new CartService($interface, $interface2);
  //   $data = $cartService->serviceGetProductsInCart(request()->validate(['cupon' => 'sometimes|alpha_num']));

  // } catch (Throwable $th) {
  //   dd($th);
  // }
  // $data = array ('msg' => 'olá');

  $ids = null;
    return in_array(1,$ids);

  return view('teste');


});

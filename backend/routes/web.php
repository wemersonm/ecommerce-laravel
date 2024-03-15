<?php

use App\Events\UserRegistered;
use App\Models\CartItem;
use App\Models\User;
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

Route::get('/', function (Request $request) {

  $user = auth()->user();
  // $cartItem = CartItem::where('cart_id', 1)->first();
  // $updated = $cartItem->update(['quantity' => 1]);
  // return view('home', ['updated' => $updated, 'cartItem' => $cartItem]);

  return $user->favorites()->latest()->get();

});

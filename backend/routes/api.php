<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\MeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {


    Route::group(['controller' => AuthController::class, 'as' => 'auth'], function () {
        route::post('/login', 'store')->name('store');
        route::post('/logout', 'destroy')->name('destroy');
        route::post('/register', 'register')->name('register');
        route::post('/forgot-password', 'forgotPassword')->name('forgot-password');
        route::post('/reset-password', 'resetPassword')->name('reset-password');

    });

    Route::group(['controller' => MeController::class, 'as' => 'me', 'prefix' => 'me'], function () {
        route::get('/', 'index')->name('index');
        route::post('/confirm-password', 'confirmPassword')->name('confirm-password');
        route::post('/change-password', 'changePassword')->name('change-password');
        route::post('/profile', 'changeEmal')->name('change-profile');
        route::put('/profile', 'changeEmal')->name('change-profile');


    });

    Route::group(['controller' => FavoritesController::class, 'prefix' => 'favorites', 'as' => 'favorites'], function () {
        route::post('/', 'store')->name('store');
        route::get('/', 'index')->name('index');
    });


    Route::group(['prefix' => 'product', 'controller' => ProductController::class, 'as' => 'product'], function () {

        route::get('/flash_sales', 'getFlashSales')->name('flash-sales');
        route::get('/best-sellers', 'getBestSellers')->name('best-sellers');
        route::get('/our-products', 'getOurProducts')->name('our-products');
        route::get('/', 'show')->name('show');

    });

    Route::group(['controller' => ReviewController::class, 'prefix' => 'review', 'as' => 'review'], function () {
        route::get('/', 'index')->name('index');
    });

    Route::group(['controller' => CartController::class, 'as' => 'cart', 'prefix' => 'cart'], function () {
        route::get('/', 'index')->name('index');
        route::post('/', 'store')->name('store');
    });

    Route::group(['controller' => CategoryController::class, 'as' => 'category'], function () {
        route::get('/categories', 'index')->name('index');
    });

    Route::group(['controller' => BannerController::class, 'as' => 'banner'], function () {
        route::get('/banners', 'index')->name('index');
    });

    Route::group(['controller' => AddressController::class, 'as' => 'address', 'prefix' => 'address'], function () {

        route::get('/', 'index')->name('index');
        route::post('/', 'store')->name('store');
        route::get('/info', 'show')->name('show');
        route::put('/', 'update')->name('update');
        route::delete('/', 'destroy')->name('destroy');
        route::put('/main-address', 'mainAddress')->name('main-address');

    });

});

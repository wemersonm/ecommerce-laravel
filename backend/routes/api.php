<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserRegistrationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {

    Route::group(['controller' => AuthController::class,], function () {

        route::post('/login', 'store')->name('store');
        route::post('/logout', 'destroy')->name('destroy');
        route::post('/forgot-password', 'notifyForgotPassword')->name('forgot-password');
        route::post('/reset-password', 'resetPassword')->name('reset-password');
    });
    Route::group(['controller' => UserRegistrationController::class,], function () {
        route::post('/register', 'store')->name('register');
    });
    Route::group(['controller' => MeController::class, 'as' => 'me', 'prefix' => 'me'], function () {
        route::get('/', 'index')->name('index');

        route::post('/confirm-password', 'confirmPassword')->name('confirm-password');

        route::post('/password', 'notifyChangePassword')->name('notify-change-password');
        route::put('/password', 'changePassword')->name('change-password');

        route::put('/', 'edit')->name('edit');

        route::post('/email', 'notifyChangeEmail')->name('notify-change-email');
        route::put('/email', 'changeEmail')->name('change-email');
    });

    Route::group(['controller' => AddressController::class, 'as' => 'address', 'prefix' => 'address'], function () {

        route::get('/', 'index')->name('index');
        route::post('/', 'store')->name('store');
        route::get('/info', 'show')->name('show');
        route::patch('/', 'update')->name('update');
        route::delete('/', 'destroy')->name('destroy');
        route::put('/main-address', 'mainAddress')->name('main-address');
    });

    Route::group(['controller' => FavoriteController::class, 'prefix' => 'favorites', 'as' => 'favorites'], function () {
        route::get('/', 'index')->name('index');
        route::post('/', 'store')->name('store');
        route::delete('/', 'destroy')->name('destroy');
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
    Route::group(['controller' => CategoryController::class, 'as' => 'category'], function () {
        route::get('/categories', 'index')->name('index');
    });
    
    // refactor ...
    Route::group(['controller' => BannerController::class, 'as' => 'banner'], function () {
        route::get('/banners', 'index')->name('index');
    });


    Route::group(['controller' => CartController::class, 'as' => 'cart', 'prefix' => 'cart'], function () {
        route::post('/', 'index')->name('index');
        route::post('/', 'store')->name('store');
    });



});

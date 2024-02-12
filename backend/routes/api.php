<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MeController;
use App\Http\Controllers\ProductController;
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

    Route::group(['prefix' => 'me', 'controller' => MeController::class, 'as' => 'me'], function () {
        route::get('/', 'index')->name('index');
    });


    Route::group(['prefix' => 'product', 'controller' => ProductController::class, 'as' => 'product'], function () {

        route::get('/flash_sales', 'getFlashSales')->name('flash_sales');
        route::get('/best-sellers', 'getBestSellers')->name('best_sellers');
        route::get('/our-products', 'getOurProducts')->name('our-products');
    });

    Route::group(['controller' => CategoryController::class, 'as' => 'category'], function () {
        route::get('/categories', 'index')->name('index');
    });

    Route::group(['controller' => BannerController::class, 'as' => 'banner'], function () {
        route::get('/banners', 'index')->name('index');
    });

});

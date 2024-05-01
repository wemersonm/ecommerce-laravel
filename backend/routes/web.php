<?php
use App\Models\Product;
use Illuminate\Http\Request;
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
Route::get('/', function (Request $request) {

    $relationships = [
        'brand',
        'category',
        'promotions.promotion',
    ];
    $user_id = 1;
    $relationships['favorites'] = function ($query) use ($user_id) {
        if ($user_id) {
            $query->where('user_id', $user_id);
        }
    };
    $product = Product::take(2)->get();
    echo $product->load($relationships);
});
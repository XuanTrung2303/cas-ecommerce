<?php

use App\Http\Controllers\HomeController;
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

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('landing-page');
    Route::get('/pd/{slug}', 'productDetail')->name('product_detail');
});

Route::view('/pd/slug', 'product_detail')->name('product_detail');
Route::view('/products', 'products')->name('products');
Route::view('/cart', 'cart')->name('cart');
Route::view('/wishlist', 'wishlist')->name('wishlist');
Route::view('/account', 'account')->name('account');

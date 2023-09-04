<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
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
    Route::get('/products', 'products')->name('products');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/logout', 'logout')->name('logout');
    Route::post('/login', 'login')->name('login');
    Route::post('/register', 'register')->name('register');
    Route::post('/forgot', 'forgot')->name('forgot');
    Route::match(['GET', 'POST'], '/reset ', 'reset')->name('reset');
});

Route::controller(AccountController::class)->group(function () {

    Route::prefix('account')->group(function () {
        Route::get('address', 'newAddress')->name('address.create');
        Route::post('address', 'newAddress')->name('address.store');
        Route::get('address/{id}', 'editAddress')->name('address.edit');
        Route::put('address/{id}', 'editAddress')->name('address.update');
    });

    Route::get('account/', 'index')->name('account.index');
    Route::post('account/', 'index')->name('account.index');
});

// Route::view('/pd/slug', 'product_detail')->name('product_detail');
Route::view('/cart', 'cart')->name('cart');
Route::view('/wishlist', 'wishlist')->name('wishlist');
// Route::view('/account', 'account')->name('account');
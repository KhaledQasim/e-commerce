<?php

use Illuminate\Support\Facades\Route;
use Gloudemans\Shoppingcart\Facades\Cart;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/test', function () {
    return view('test');
});

Route::middleware('auth')->group(function () {
    Route::get('/myProfile', 'App\Http\Controllers\UsersController@edit')->name('users.edit');
    Route::patch('/myProfile', 'App\Http\Controllers\UsersController@update')->name('users.update');

    Route::get('/myOrders', 'App\Http\Controllers\OrdersController@index')->name('orders.index');
    Route::get('/myOrders/{order}', 'App\Http\Controllers\OrdersController@show')->name('orders.show');
});


Route::get('/shop-{type}', 'App\Http\Controllers\ShopController@index')->name('shopIndex');


Route::get('/shop/{product}', 'App\Http\Controllers\ShopController@show')->name('shop.show');

// Route::get('/cart', function () {
//     return view('cart');
// });

Route::get('/cart', 'App\Http\Controllers\CartController@index')->name('cart.index');
Route::post('/cart/{product}', 'App\Http\Controllers\CartController@store')->name('cart.store');
Route::delete('/cart/{product}', 'App\Http\Controllers\CartController@destroy')->name('cart.destroy');
Route::patch('/cart/{product}', 'App\Http\Controllers\CartController@update')->name('cart.update');
Route::post('/cart/switchToSaveForLater/{product}', 'App\Http\Controllers\CartController@switchToSaveForLater')->name('cart.switchToSaveForLater');

Route::delete('/saveForLater/{product}', 'App\Http\Controllers\SaveForLaterController@destroy')->name('saveForLater.destroy');
Route::post('/saveForLater/switchToCart/{product}', 'App\Http\Controllers\SaveForLaterController@switchToCart')->name('saveForLater.switchToCart');

Route::get('empty', function () {
    Cart::instance('saveForLater')->destroy();
});

Route::get('/checkout', 'App\Http\Controllers\CheckoutController@index')->name('checkout.index');

Route::post('/session', 'App\Http\Controllers\StripeController@session')->name('strip.session');
Route::get('/success', 'App\Http\Controllers\StripeController@success')->name('confirmation.index');

Route::get('/about', function () {
    return view('about');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});


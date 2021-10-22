<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'Api\UserController@login'); //[All User]
Route::post('register', 'Api\UserController@register'); //[Customer]

Route::get('email/verify/{id}', 'Api\VerificationController@verify')->name('verification.verify'); // Make sure to keep this as your route name
Route::get('email/resend', 'Api\VerificationController@resend')->name('verification.resend');

Route::get('product/displays', 'Api\FrontController@index');


Route::middleware(['cors'])->group(function () {
    Route::get('/reports/inquiry/{invoice_loop}', 'Web\ReportsController@inquiryDetails');
});

// Order
Route::get('carts', 'Api\CartController@show');
Route::post('cart/add', 'Api\CartController@addToCart');
Route::put('cart/update/{order_id}', 'Api\CartController@updateCart');
Route::delete('cart/delete/{order_id}', 'Api\CartController@destroyCart');

// Check out
Route::post('cart/check-out', 'Api\CartController@processCheckout');
Route::get('cart/check-out/{invoice}', 'Api\CartController@checkoutFinish');

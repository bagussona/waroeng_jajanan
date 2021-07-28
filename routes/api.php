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

// Route::Auth();

// Route::group(
    // 'middleware' => ['jwt.verify', 'role:admin|customer|staff|bendahara|pengepul'], function () {

    Route::post('login', 'Api\UserController@login'); //[All User]
    Route::post('register', 'Api\UserController@register'); //[Customer]
    // Route::post('password/reset/email', 'Api\ForgotPasswordController@forgot');
    // Route::post('password/reset', 'Api\ForgotPasswordController@reset');

// });

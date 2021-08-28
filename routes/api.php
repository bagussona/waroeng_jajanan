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

Route::middleware(['cors'])->group(function () {
    Route::get('/reports/inquiry/{invoice_loop}', 'Web\ReportsController@inquiryDetails');
});

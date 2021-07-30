<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes(['verify' => true]);

// Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');


##dikomen dlu krn sdg maintenance!
// Route::get('/', function () {
//     return view('welcome');
// });


// Route::group([
//     'prefix' => 'administrator',
//     'middleware' => 'auth'
// ], function() {
    Route::get('/admin', 'Web\HomeController@index')->name('home'); //index admin

    Route::get('/category', 'Web\CategoryController@index')->name('category.index'); //index category
    Route::post('/category', 'Web\CategoryController@store')->name('category.store');
    Route::get('/category/{category_id}/edit', 'Web\CategoryController@edit')->name('category.edit');
    Route::put('/category/{category_id}', 'Web\CategoryController@edit')->name('category.update');
    Route::delete('/category/{category_id}', 'Web\CategoryController@destroy')->name('category.destroy');

    Route::get('/products', 'Web\ProductController@index')->name('products.index'); //index product
    Route::get('/products/show', 'Web\ProductController@create')->name('products.create');
    Route::post('/products/show', 'Web\ProductController@store')->name('products.store');
    Route::get('/products/{products_id}/edit', 'Web\ProductController@edit')->name('products.edit');
    Route::put('/products/{products_id}', 'Web\ProductController@edit')->name('products.update');
    Route::delete('/products/{products_id}', 'Web\ProductController@destroy')->name('products.destroy');
    // Route::resource('product', 'Web\ProductController');

// });

// Route::get('/', 'Ecommerce\FrontController@index')->name('front.index')->middleware('verified');
Route::get('/', 'Ecommerce\FrontController@index')->name('front.index'); //index guest
Route::get('/user/contact', 'UserProfile\UserProfileController@contactUs')->name('front.UserContact'); //index contact pengaduan

Route::group([
    'middleware' => ['verified']
], function () {

Route::get('/product', 'Ecommerce\FrontController@product')->name('front.product'); //index home
Route::get('/category/{name}', 'Ecommerce\FrontController@categoryProduct')->name('front.category');
Route::get('/product/{name}', 'Ecommerce\FrontController@show')->name('front.show_product');

Route::post('cart', 'Ecommerce\CartController@addToCart')->name('front.cart');
Route::get('/cart', 'Ecommerce\CartController@listCart')->name('front.list_cart');
Route::post('/cart/update', 'Ecommerce\CartController@updateCart')->name('front.update_cart');

Route::get('/checkout', 'Ecommerce\CartController@checkout')->name('front.checkout');

Route::post('/checkout', 'Ecommerce\CartController@processCheckout')->name('front.store_checkout');
Route::get('/checkout/{invoice}', 'Ecommerce\CartController@checkoutFinish')->name('front.finish_checkout');

// ini buat render di semua header
Route::get('/notfound', 'Ecommerce\CartController@notfound')->name('front.notfound'); //index notfound

//ini profile
Route::get('/user/profile', 'UserProfile\UserProfileController@index')->name('front.UserProfile'); //index profile

});

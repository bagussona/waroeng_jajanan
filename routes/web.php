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

    //Category Management
    Route::get('/admin/category', 'Web\CategoryController@index')->name('category.index'); //index category
    Route::post('/admin/category', 'Web\CategoryController@store')->name('category.store');
    Route::get('/admin/category/{category_id}/edit', 'Web\CategoryController@edit')->name('category.edit');
    Route::put('/admin/category/{category_id}/edit', 'Web\CategoryController@update')->name('category.update');
    Route::delete('/admin/category/{category_id}/delete', 'Web\CategoryController@destroy')->name('category.destroy');

    //Supplier Management
    Route::get('/admin/supplier', 'Web\SupplyController@index')->name('supplier.index'); //index supplier
    Route::post('/admin/supplier', 'Web\SupplyController@store')->name('supplier.store');
    Route::get('/admin/supplier/{supplier_id}/edit', 'Web\SupplyController@edit')->name('supplier.edit');
    Route::put('/admin/supplier/{supplier_id}/edit', 'Web\SupplyController@update')->name('supplier.update');
    Route::delete('/admin/supplier/{supplier_id}/delete', 'Web\SupplyController@destroy')->name('supplier.destroy');

    //Products Management
    Route::get('/admin/products', 'Web\ProductController@index')->name('products.index'); //index product
    Route::get('/admin/products/show', 'Web\ProductController@create')->name('products.create');
    Route::post('/admin/products/show', 'Web\ProductController@store')->name('products.store');
    Route::get('/admin/products/{products_id}/edit', 'Web\ProductController@edit')->name('products.edit');
    Route::put('/admin/products/{products_id}/edit', 'Web\ProductController@update')->name('products.update');
    Route::delete('/admin/products/{products_id}/delete', 'Web\ProductController@destroy')->name('products.destroy');

    //Store Management
    Route::get('/admin/store', 'Web\SpbController@index')->name('datastore.index');
    Route::post('/admin/store', 'Web\SpbController@store')->name('datastore.store');
    Route::post('/admin/store/bbk', 'Web\SpbController@store')->name('datastore.bbk');
    Route::delete('/admin/store/{spb_id}/delete', 'Web\SpbController@destroy')->name('datastore.destroy');

// });

//Toko Display
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

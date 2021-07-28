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

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');


<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Redirect;

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

##dikomen dlu krn sdg maintenance!
// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');


Route::group([
    'prefix' => 'administrator',
    'middleware' => 'auth'
], function() {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/category', 'CategoryController@index')->name('category.index');
    Route::post('/category', 'CategoryController@store')->name('category.store');
    Route::get('/category/{category_id}/edit', 'CategoryController@edit')->name('category.edit');
    Route::put('/category/{category_id}', 'CategoryController@edit')->name('category.update');
    Route::delete('/category/{category_id}', 'CategoryController@destroy')->name('category.destroy');

    Route::resource('product', 'ProductController');

});

Route::get('/', 'Ecommerce\FrontController@index')->name('front.index');

Route::get('/product', 'Ecommerce\FrontController@product')->name('front.product');
Route::get('/category/{slug}', 'Ecommerce\FrontController@categoryProduct')->name('front.category');
Route::get('/product/{slug}', 'Ecommerce\FrontController@show')->name('front.show_product');

Route::post('cart', 'Ecommerce\CartController@addToCart')->name('front.cart');
Route::get('/cart', 'Ecommerce\CartController@listCart')->name('front.list_cart');
Route::post('/cart/update', 'Ecommerce\CartController@updateCart')->name('front.update_cart');

Route::get('/checkout', 'Ecommerce\CartController@checkout')->name('front.checkout');

Route::post('/checkout', 'Ecommerce\CartController@processCheckout')->name('front.store_checkout');
Route::get('/checkout/{invoice}', 'Ecommerce\CartController@checkoutFinish')->name('front.finish_checkout');

// ini buat render di semua header
Route::get('/qtyCart', 'Ecommerce\CartController@listloved')->name('front.listLoved');

//ini profile
Route::get('/user/profile', 'UserProfile\UserProfileController@index')->name('front.UserProfile');
Route::get('/user/contact', 'UserProfile\UserProfileController@contactUs')->name('front.UserContact');


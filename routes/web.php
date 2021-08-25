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

Auth::routes(['verify' => true]);

Route::group([
    'middleware' => ['verified', 'role:admin|staff']
], function () {

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
    Route::get('/admin/products/display', 'Web\ProductController@display')->name('products.display'); //index product
    Route::get('/admin/products/show', 'Web\ProductController@create')->name('products.create');
    Route::post('/admin/products/show', 'Web\ProductController@store')->name('products.store');
    Route::get('/admin/products/{products_id}/edit', 'Web\ProductController@edit')->name('products.edit');
    Route::put('/admin/products/{products_id}/edit', 'Web\ProductController@update')->name('products.update');
    Route::delete('/admin/products/{products_id}/delete', 'Web\ProductController@destroy')->name('products.destroy');

    //Store Management
    Route::get('/admin/store', 'Web\SpbController@index')->name('datastore.index');
    Route::post('/admin/store', 'Web\SpbController@store')->name('datastore.store');
    Route::post('/admin/store/bbk', 'Web\SpbController@bbk')->name('datastore.bbk');
    Route::put('/admin/store/bbmWarehouse', 'Web\SpbController@bbmWarehouse')->name('datastore.bbmWarehouse');
    Route::delete('/admin/store/{spb_id}/BBK/delete', 'Web\SpbController@destroy')->name('datastore.destroyBBK');
    Route::delete('/admin/store/{spb_id}/BBM/delete', 'Web\SpbController@destroyBBM')->name('datastore.destroyBBM');
    Route::get('/admin/store/bbm', 'Web\SpbController@bbmindex')->name('datastore.bbmindex');
    Route::post('/admin/store/bbm', 'Web\SpbController@bbm')->name('datastore.bbm');

    //Order Management
    Route::get('/admin/orderan', 'UserProfile\UserProfileController@orderan')->name('orderan.index');
    Route::post('/admin/orderan', 'UserProfile\UserProfileController@view')->name('orderan.view');
    Route::put('/admin/orderan/done', 'UserProfile\UserProfileController@updateOrderan')->name('orderan.updateSelesai');

    //Reports Management
    Route::get('/reports/daily', 'Web\ReportsController@index')->name('reports.daily');
    Route::get('/reports/pdf/daily', 'Web\ReportsController@dummy')->name('reports.daily_pdf');
    Route::get('/reports/daily/pdf', 'Web\ReportsController@createPDF')->name('reports.pdf_daily');
    Route::get('/reports/inquiry', 'Web\ReportsController@inquiry')->name('reports.inquiry');
    Route::post('/reports/inquiry', 'Web\ReportsController@inquiryPost')->name('reports.inquiryPost');
});

    //Toko Display
    Route::get('/', 'Ecommerce\FrontController@index')->name('front.index'); //index guest
    Route::get('/product', 'Ecommerce\FrontController@product')->name('front.product'); //index home
    Route::get('/category/{slug}', 'Ecommerce\FrontController@categoryProduct')->name('front.category');
    Route::get('/product/{slug}', 'Ecommerce\FrontController@show')->name('front.show_product');

    // ini buat render semua yg belum dibikin view nya hehe
    Route::get('/notfound', 'Ecommerce\CartController@notfound')->name('front.notfound'); //index notfound

    //email-subscribe
    Route::get('/user/contact', 'UserProfile\UserProfileController@contactUs')->name('front.UserContact'); //index contact pengaduan

Route::group([
    'middleware' => ['verified', 'role:admin|staff|customer']
], function () {

    //CART
    Route::post('cart', 'Ecommerce\CartController@addToCart')->name('front.cart');
    Route::get('/cart', 'Ecommerce\CartController@listCart')->name('front.list_cart');
    Route::post('/cart/update', 'Ecommerce\CartController@updateCart')->name('front.update_cart');
    Route::delete('/cart/delete', 'Ecommerce\CartController@destroyCart')->name('front.delete_cart');

    //CHECKOUT
    Route::get('/checkout', 'Ecommerce\CartController@checkout')->name('front.checkout');
    Route::post('/checkout', 'Ecommerce\CartController@processCheckout')->name('front.store_checkout');
    Route::get('/checkout/{invoice}', 'Ecommerce\CartController@checkoutFinish')->name('front.finish_checkout');

    //PROFILE
    Route::get('/user/profile', 'UserProfile\UserProfileController@index')->name('front.UserProfile'); //index profile
    Route::put('/user/profile', 'UserProfile\UserProfileController@update')->name('front.UpdateProfile'); //update profile
    Route::post('/user/profile/orderan', 'UserProfile\UserProfileController@viewCustomer')->name('front.OrderanView');
    // Route::get('/userupload',[UploadController::class, 'index']);
    Route::post('/user/profile/crop', 'UserProfile\UserProfileController@crop')->name('crop');


});

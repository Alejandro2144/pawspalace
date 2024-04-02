<?php

use Illuminate\Support\Facades\Auth;
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

// Home Controller routes
// User routes
Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home.index');
Route::get('/about', 'App\Http\Controllers\HomeController@about')->name('home.about');
Route::get('/products', 'App\Http\Controllers\ProductController@index')->name('product.index');
Route::get('/products/{id}', 'App\Http\Controllers\ProductController@show')->name('product.show');

Route::middleware('auth')->group(function () {
    Route::get('/cart/purchase', 'App\Http\Controllers\CartController@purchase')->name('cart.purchase');
    Route::get('/my-account/orders', 'App\Http\Controllers\MyAccountController@orders')->name('myaccount.orders');
});

// Admin routes
Route::middleware('admin')->group(function () {
    Route::get('/admin', 'App\Http\Controllers\Admin\AdminHomeController@index')->name('admin.home.index');
    Route::get('/admin/products', 'App\Http\Controllers\Admin\AdminProductController@index')->name('admin.product.index');
    Route::post('/admin/products/store', 'App\Http\Controllers\Admin\AdminProductController@store')->name('admin.product.store');
    Route::delete('/admin/products/{id}/delete', 'App\Http\Controllers\Admin\AdminProductController@delete')->name('admin.product.delete');
    Route::get('/admin/products/{id}/edit', 'App\Http\Controllers\Admin\AdminProductController@edit')->name('admin.product.edit');
    Route::put('/admin/products/{id}/update', 'App\Http\Controllers\Admin\AdminProductController@update')->name('admin.product.update');

    Route::get('/admin/appointment', 'App\Http\Controllers\Admin\AdminAppointmentController@index')->name('admin.appointment.index');
    Route::post('/admin/appointment/store', 'App\Http\Controllers\Admin\AdminAppointmentController@store')->name('admin.appointment.store');
    Route::delete('/admin/appointment/{id}/delete', 'App\Http\Controllers\Admin\AdminAppointmentController@delete')->name('admin.appointment.delete');
    Route::get('/admin/appointment/{id}/edit', 'App\Http\Controllers\Admin\AdminAppointmentController@edit')->name('admin.appointment.edit');
    Route::put('/admin/appointment/{id}/update', 'App\Http\Controllers\Admin\AdminAppointmentController@update')->name('admin.appointment.update');

});

// Shopping Cart routes
Route::get('/cart', 'App\Http\Controllers\CartController@index')->name('cart.index');
Route::get('/cart/delete', 'App\Http\Controllers\CartController@delete')->name('cart.delete');
Route::post('/cart/add/{id}', 'App\Http\Controllers\CartController@add')->name('cart.add');
Route::post('/cart/remove/{id}', 'App\Http\Controllers\CartController@remove')->name('cart.remove');
Route::post('/cart/add-appointment/{id}', 'App\Http\Controllers\CartController@add')->name('cart.add-appointment');

//Appointment routes
Route::post('/appointment/store', 'App\Http\Controllers\AppointmentController@store')->name('appointment.store');
Route::get('/appointment', 'App\Http\Controllers\AppointmentController@index')->name('appointment.index');

// Review routes
Route::get('reviews/create/{productId}', 'App\Http\Controllers\ReviewController@create')->name('review.create');
Route::post('/review/save/', 'App\Http\Controllers\ReviewController@save')->name('review.save');
Route::delete('/review/delete/{id}/', 'App\Http\Controllers\ReviewController@delete')->name('review.delete');
Route::get('/review/{id}/', 'App\Http\Controllers\ReviewController@show')->name('review.show');
Route::get('/review/{id}/edit', 'App\Http\Controllers\ReviewController@edit')->name('review.edit');
Route::put('/review/{id}/update', 'App\Http\Controllers\ReviewController@update')->name('review.update');
Route::get('/reviews/{product_id}', 'App\Http\Controllers\ReviewController@list')->name('review.list');

// Authentication Controllers routes
Auth::routes();

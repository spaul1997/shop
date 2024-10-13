<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;

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
    Route::get('/', 'index')->name('home');
    Route::get('/checkout', 'checkout')->name('checkout');
    Route::get('/payment', 'payment')->name('payment');
    Route::post('/order-now', 'order_now')->name('order-now');
    Route::post('/add-to-cart', 'add_to_cart')->name('add-to-cart');
    Route::get('/remove-cart/{pid}', 'remove_cart')->name('remove-cart');
    Route::get('/thank-you', 'thank_you')->name('thank-you');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::get('/register', 'register')->name('register');
    Route::post('/add-user', 'add_user')->name('add-user');
    Route::post('/check-users', 'check_users')->name('check-users');
    Route::get('/logout', 'logout')->name('logout');
});

Route::middleware('user.check')->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/products', 'index')->name('dashboard');
        Route::get('/add-product', 'add_product')->name('add-product');
        Route::get('/edit-product/{pid}', 'edit_product')->name('edit-product');
        Route::get('/delete-product/{pid}', 'delete_product')->name('delete-product');
        Route::post('/update-product/{id?}', 'update_product')->name('update-product');
    });
    Route::controller(OrderController::class)->group(function () {
        Route::get('/orders', 'index')->name('orders');
        Route::get('/orders-details/{oid}', 'orders_details')->name('orders-details');
        Route::post('/update-status', 'update_status')->name('update-status');
        Route::get('/my-orders', 'my_orders')->name('my-orders');
        Route::get('/my-orders-details/{oid}', 'my_orders_details')->name('my-orders-details');
    });
});

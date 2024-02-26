<?php

use App\Http\Controllers\Clinic\ClinicController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Patient\PatientController;
use Illuminate\Support\Facades\Route;

Route::namespace('Frontend')->controller(FrontendController::class)->group(function () {
    Route::get('/home', 'index')->name('home');
    Route::get('/menu', 'menu')->name('menu');
    Route::get('/cart', 'cart')->name('cart');
    // Route::match(['get', 'post'], '/registration', 'registration')->name('registration');
    // Route::get('/login', 'login')->name('login');
    Route::middleware(['auth'])->group(function () {
        Route::get('/logout', 'logout')->name('logout');
        Route::post('/add-to-cart', 'addToCart')->name('cart.addToCart');
        Route::post('/update-quantity', 'updateQuantity')->name('cart.updateQuantity');
        Route::post('/item-order', 'itemOrder')->name('item.order');
        Route::match(['get', 'post'], '/dalivery-address-add-edit', 'daliveryAddressAdd')->name('order.dalivery-address.add-edit');
        Route::get('/dalivery-address-list', 'daliveryAddressList')->name('order.dalivery-address.list');
        Route::match(['get', 'post'], '/change-dalivery-address-list', 'changeDaliveryAddressList')->name('order.dalivery-address.address-list');
    });
});
// Route::namespace('Cart')->prefix('cart')->as('cart.')->controller(CartController::class)->group(function () {
// Route::controller(CartController::class)->group(function () {
// });

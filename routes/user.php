<?php

use App\Http\Controller\Clinic\ClinicController;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;




Route::middleware(['auth'])->prefix('user')->as('user.')->group(function () {
    Route::namespace('User')->controller(UserController::class)->prefix('dashboard')->as('dashboard.')->group(function () {
            Route::get('/home', 'list')->name('home');
            Route::get('/my-order', 'myOrder')->name('myOrder');
            Route::get('/user-profile', 'profile')->name('profile');
       
    });
    // Route::namespace('Order')->prefix('order')->as('order.')->controller(OrderController::class)->group(function () {
    //     Route::get('/list', 'list')->name('list');
    //     Route::get('/add', 'add')->name('add');
    // });
});

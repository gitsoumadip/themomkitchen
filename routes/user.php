<?php

use App\Http\Controller\Clinic\ClinicController;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;




Route::middleware(['auth'])->prefix('user')->as('user.')->group(function () {
    Route::namespace('User')->controller(UserController::class)->prefix('dashboard')->as('dashboard.')->group(function () {
        // return "ssssssss";
            Route::get('/home', 'list')->name('home');
        //     Route::get('/dashboard', 'home')->name('index');
    });
    // Route::namespace('Cart')->prefix('cart')->as('cart.')->controller(CartController::class)->group(function () {
    //     Route::get('/list', 'list')->name('list');
    //     Route::get('/add-to-cart/{uuid}', 'add')->name('add');
    //     // Route::match(['get', 'post'], '/add', 'add')->name('add');
    // });
});

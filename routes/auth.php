<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    
    Route::prefix('admin')->as('admin.')->group(function () {
        Route::match(['get', 'post'], '/login', 'login')->name('login');
        Route::get('/logout', 'logout')->name('logout');
    });

    Route::prefix('user')->as('user.')->group(function () {
        Route::match(['get', 'post'], '/login', 'userLogin')->name('login');
        Route::match(['get', 'post'], '/signup', 'userSignup')->name('signup');
        Route::get('/logout', 'logout')->name('logout');
    });

});

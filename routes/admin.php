<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Item\ItemController;
use App\Http\Controllers\location\LocationController;
use App\Http\Controllers\Menu\MenuController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\RolePermission\PermissionController;
use App\Http\Controllers\RolePermission\RoleController;
use App\Http\Controllers\Type\TypeController;
use App\Http\Controllers\User\UserController;

Route::middleware(['auth'])->prefix('admin')->as('admin.')->group(function () {
    Route::namespace('Admin')->controller(ProfileController::class)->group(function () {
        Route::get('/profile-view', 'profileView')->name('profile.view');
        Route::post('/profile-update', 'profileUpdate')->name('profile.update');
        Route::get('/password-chenge', 'newPassword')->name('password.chenge');
        Route::post('/password-update', 'passwordUpdate')->name('password.update');
    });

    // Dashboard
    Route::controller(DashboardController::class)->prefix('dashboard')->as('dashboard.')->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
    });

    // Category
    Route::namespace('Category')->prefix('category')->as('category.')->controller(CategoryController::class)->group(function () {
        Route::get('/list', 'index')->name('list');
        Route::get('/edit/{uuid}', 'edit')->name('edit');
        Route::match(['get', 'post'], '/add', 'add')->name('add');
    });

    // Create User Wise Permissions
    Route::namespace('RolePermission')->as('user-permission.')->prefix('user-permission')->controller(PermissionController::class)->group(function () {
        Route::get('/list', 'index')->name('list');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::match(['get', 'post'], '/add', 'add')->name('add');
        Route::get('/permission/{id}', 'permission')->name('permission');
    });

    // Create Role Wise Permissions
    Route::namespace('RolePermission')->as('role-permission.')->prefix('role-permission')->controller(RoleController::class)->group(function () {
        Route::get('/list', 'index')->name('list');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::match(['get', 'post'], '/add', 'add')->name('add');
        Route::get('/permission/{id}', 'permission')->name('permission');
    });

    Route::namespace('Menu')->prefix('menu')->as('menu.')->controller(MenuController::class)->group(function () {
        Route::get('/list', 'index')->name('list');
        Route::get('/edit/{uuid}', 'edit')->name('edit');
        Route::match(['get', 'post'], '/add', 'add')->name('add');

        // Route::get('/list', 'menuItem')->name('menulist');

    });

    Route::namespace('Type')->prefix('type')->as('type.')->controller(TypeController::class)->group(function () {
        Route::get('/list', 'index')->name('list');
        Route::get('/edit/{uuid}', 'edit')->name('edit');
        Route::match(['get', 'post'], '/add', 'add')->name('add');
    });

    Route::namespace('Item')->prefix('item')->as('item.')->controller(ItemController::class)->group(function () {
        Route::get('/list', 'index')->name('list');
        Route::get('/edit/{uuid}', 'edit')->name('edit');
        Route::match(['get', 'post'], '/add', 'add')->name('add');
    });

    Route::namespace('location')->prefix('location')->as('location.')->controller(LocationController::class)->group(function () {
        Route::get('/list', 'index')->name('list');
        Route::get('/edit/{uuid}', 'edit')->name('edit');
        Route::match(['get', 'post'], '/add', 'add')->name('add');
    });

    // ******************************Order*******************************************************************
    Route::namespace('Order')->prefix('order')->as('order.')->controller(OrderController::class)->group(function () {
        Route::get('/list', 'index')->name('list');
        Route::get('/edit/{uuid}', 'edit')->name('edit');
        Route::match(['get', 'post'], '/add', 'add')->name('add');
        // Route::post('/add-to-cart', 'addToCart')->name('addToCart');
    });

    // ****************************Customer*********************************************************************
    // Customer 
    Route::namespace('User')->prefix('customer')->as('customer.')->controller(UserController::class)->group(function () {
        Route::get('/list', 'list')->name('list');
        Route::get('/edit/{uuid}', 'edit')->name('edit');
        Route::match(['get', 'post'], '/add', 'add')->name('add');
    });
});

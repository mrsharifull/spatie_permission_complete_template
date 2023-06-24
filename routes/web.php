<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\admin\HomeController as AdminHomeController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\PermissionController;


Auth::routes();

// Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/', [AdminHomeController::class, 'index'])->name('admin.home');

// User Routes
Route::group(['as' => 'user.', 'prefix' => '/user/info'], function () {
    Route::get('/view', [UserController::class, 'index'])->name('view');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/store', [UserController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [UserController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [UserController::class, 'delete'])->name('delete');
    Route::get('/details/{id}', [UserController::class, 'details'])->name('details');

});

// User Role Routes
Route::group(['as' => 'role.', 'prefix' => '/user/role'], function () {
    Route::get('/view', [RoleController::class, 'index'])->name('view');
    Route::get('/create', [RoleController::class, 'create'])->name('create');
    Route::post('/store', [RoleController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [RoleController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [RoleController::class, 'delete'])->name('delete');
    Route::get('/details/{id}', [RoleController::class, 'details'])->name('details');
});

// User Permission Routes
Route::group(['as' => 'permission.', 'prefix' => '/user/permission'], function () {
    Route::get('/view', [PermissionController::class, 'index'])->name('view');
    Route::get('/create', [PermissionController::class, 'create'])->name('create');
    Route::post('/store', [PermissionController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [PermissionController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [PermissionController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [PermissionController::class, 'delete'])->name('delete');
    Route::get('/details/{id}', [PermissionController::class, 'details'])->name('details');
});







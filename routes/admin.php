<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\QuatationLogBookController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified', 'has_permission',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // category
    // Route::resource('categories', CategoryController::class)->except(['show']);
    // Route::get('categories/recycle-bin', [CategoryController::class, 'recycleBin'])->name('categories.recycleBin');
    // Route::post('categories/restore/{id}', [CategoryController::class, 'restore'])->name('categories.restore');
    // Route::delete('categories/force-delete/{id}', [CategoryController::class, 'forceDelete'])->name('categories.forceDelete');

    // quatation log book
    Route::resource('quatation-log-books', QuatationLogBookController::class)->except(['create', 'show']);
    Route::get('quatation-log-books/recycle-bin', [QuatationLogBookController::class, 'recycleBin'])->name('quatation-log-books.recycleBin');
    Route::post('quatation-log-books/restore/{id}', [QuatationLogBookController::class, 'restore'])->name('quatation-log-books.restore');
    Route::delete('quatation-log-books/force-delete/{id}', [QuatationLogBookController::class, 'forceDelete'])->name('quatation-log-books.forceDelete');

    // role & permission
    Route::resource('roles', RoleController::class)->except(['show']);
    Route::get('roles/recycle-bin', [RoleController::class, 'recycleBin'])->name('roles.recycleBin');
    Route::post('roles/restore/{id}', [RoleController::class, 'restore'])->name('roles.restore');
    Route::delete('roles/force-delete/{id}', [RoleController::class, 'forceDelete'])->name('roles.forceDelete');

    Route::get('add-permission/{id}', [RoleController::class, 'addPermission'])->name('roles.addPermission');
    Route::post('add-permission/{id}', [RoleController::class, 'permissionStore'])->name('roles.permissions.store');

    // users
    Route::resource('users', UserController::class)->except(['show']);
    Route::get('users/recycle-bin', [UserController::class, 'recycleBin'])->name('users.recycleBin');
    Route::post('users/restore/{id}', [UserController::class, 'restore'])->name('users.restore');
    Route::delete('users/force-delete/{id}', [UserController::class, 'forceDelete'])->name('users.forceDelete');
});

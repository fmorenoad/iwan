<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\EnterpriseController;


/* Route::get('', [AdminController::class,'index']); */
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('', [AdminController::class,'index'])->name('admin.index');
    Route::resource('permissions', PermissionController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::put('users/{user}', [UserController::class, 'update_admin'])->name('users.update_admin');
    Route::resource('enterprises', EnterpriseController::class);
    Route::resource('config', EnterpriseController::class);
});


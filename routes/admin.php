<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;

Route::get('', [AdminController::class,'index']);
Route::resource('permission', PermissionController::class);
Route::resource('role', RoleController::class);

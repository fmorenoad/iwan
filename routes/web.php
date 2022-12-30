<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Api\PasasteSinTagController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'welcome');

Route::get('/get_transitos_urbanos', [PasasteSinTagController::class, 'get_transitos_urbanos']);
Route::get('/get_transitos_interurbanos', [PasasteSinTagController::class, 'get_transitos_interurbanos']);
Route::get('/get_pases_diarios', [PasasteSinTagController::class, 'get_pases_diarios']);
Route::get('/enviar-deuda', [PasasteSinTagController::class, 'ingreso_deuda_pst']);


//Route::get('/api', [PasasteSinTagController::class, 'ingreso_deuda_pst']);
//Route::get('/home', [HomeController::class, 'index'])->name('home');

/* Route::view('password/reset','welcome')->name('password.reset'); */

/* Route::prefix('admin')->group(function () {
    Route::get('/permission',[Permission]);
}); */

Route::group(['middleware' => 'auth'], function () {
    /* Route::get('profile', 'ProfileController@edit')->name('profile.edit');
    Route::patch('profile/update', 'ProfileController@update')->name('profile.update');
    Route::patch('profile/password', 'ProfileController@password')->name('profile.password');
    
    Route::resource('user', 'UserController', ['except' => ['show']]);
    Route::resource('category', 'CategoryController', ['except' => ['show']]);
    Route::resource('tag', 'TagController', ['except' => ['show']]);
    Route::resource('item', 'ItemController', ['except' => ['show']]);
    Route::resource('role', 'RoleController', ['except' => ['show']]);

    Route::get('{page}', 'PageController@index')->name('page.index'); */

    // Rutas agregadas por iWan
    Route::get('admin/permissions', [PermissionController::class, 'index'])->name('admin.permissions.index');
    Route::get('admin/permissions/create', [PermissionController::class, 'create'])->name('admin.permissions.create');
    Route::post('admin/permissions/create', [PermissionController::class, 'store'])->name('admin.permissions.store');
    Route::get('admin/permissions/edit/{permission}', [PermissionController::class, 'edit'])->name('admin.permissions.edit');
    Route::put('admin/permissions/edit/{permission}', [PermissionController::class, 'update'])->name('admin.permissions.update');
    Route::delete('admin/permissions/destroy/{permission}', [PermissionController::class, 'destroy'])->name('admin.permissions.destroy');
    
    Route::get('admin/roles', [RoleController::class, 'index'])->name('admin.roles.index');
    Route::get('admin/roles/create', [RoleController::class, 'create'])->name('admin.roles.create');
    Route::post('admin/roles/create', [RoleController::class, 'store'])->name('admin.roles.store');
    Route::get('admin/roles/edit/{role}', [RoleController::class, 'edit'])->name('admin.roles.edit');
    Route::put('admin/roles/edit/{role}', [RoleController::class, 'update'])->name('admin.roles.update');
    Route::delete('admin/roles/destroy/{role}', [RoleController::class, 'destroy'])->name('admin.roles.destroy');

    Route::get('admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('admin/users/create', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('admin/users/edit/{user}', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('admin/users/edit/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('admin/users/destroy/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});
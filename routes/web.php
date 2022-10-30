<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\PermissionController;

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
Route::get('/home', [HomeController::class, 'index'])->name('home');

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
});
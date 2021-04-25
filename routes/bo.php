<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BO\BOController;

Route::get('', [BOController::class, 'index']);

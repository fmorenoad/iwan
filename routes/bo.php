<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BO\BOController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('', [BOController::class, 'index']);
});


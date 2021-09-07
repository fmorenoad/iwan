<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\BO\ReceiptController;


Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('receipt', ReceiptController::class);
    Route::get('receipt/{receipt}/sampling', [ReceiptController::class, 'create_sampling'])->name('receipt.sampling.create');
    Route::post('receipt/{receipt}/sampling', [ReceiptController::class, 'store_sampling'])->name('receipt.sampling.store');
    Route::patch('receipt/{receipt}/sampling/{sampling}', [ReceiptController::class, 'update_sampling'])->name('receipt.sampling.update');

    Route::get('receipt/{receipt}/dump-truck', [ReceiptController::class, 'create_dump_truck'])->name('receipt.dump_truck.create');
    Route::post('receipt/{receipt}/dump-truck', [ReceiptController::class, 'store_dump_truck'])->name('receipt.dump_truck.store');

    Route::get('receipt/{receipt}/check-out', [ReceiptController::class, 'create_check_out'])->name('receipt.check_out.create');
    Route::post('receipt/{receipt}/check-out', [ReceiptController::class, 'store_check_out'])->name('receipt.check_out.store');


    Route::resource('production', PermissionController::class);
    Route::resource('labelled', PermissionController::class);
    Route::resource('request', PermissionController::class);
    Route::resource('approve', PermissionController::class);
    Route::resource('dispatch', PermissionController::class);
});

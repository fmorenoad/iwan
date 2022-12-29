<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ScadaController;

Route::post('login', [AuthController::class, 'login'])->name('api.login');
Route::post('register', [AuthController::class, 'register'])->name('api.register');

Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('logout', [AuthController::class, 'logout']);    
});

Route::middleware('auth:sanctum')->post('/recibo_informe_pago', [ScadaController::class, 'recibo_informe_pago'])->name('api.recibo_informe_pago');
Route::middleware('auth:sanctum')->post('/recibir_anular_pago', [ScadaController::class, 'recibir_anular_pago'])->name('api.recibir_anular_pago');

<?php

use App\Http\Controllers\Api\ScadaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->post('/recibo_informe_pago', [ScadaController::class, 'recibo_informe_pago'])->name('api.v1.recibo_informe_pago');
Route::middleware('auth:sanctum')->post('/recibir_anular_pago', [ScadaController::class, 'recibir_anular_pago'])->name('api.v1.recibir_anular_pago');

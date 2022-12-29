<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Anulacion;
use App\Models\Pago;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ScadaController extends Controller
{
    public function recibo_informe_pago(Request $request)
    {
        $now = Carbon::now()->format('Ymd HHMMII');
        $file = Storage::disk('local')->put( "recibo_informe_pago".$now.".txt", $request);

        foreach($request->pago as $pago)
        {
            $pago_pase_diario = new Pago([
                "identificador" => $pago->identificador,
                "monto" => $pago->monto,
                "comprobante" => $pago->comprobante,
                "fecha_pago" => $pago->fecha_pago,
                "canal_pago_id" => $pago->canal_pago_id,
                "forma_pago_id" => $pago->forma_pago_id,
                "estado" => 0
            ]); 

            $pago_pase_diario->save();
        }

        return [
            "status" => "success",
            "message" => "data recibida",
            "code" => 200
        ];

        #Pendiente: Enviar pago a BO, modificar estado de pago de pase diario detalle y pase diario.
    }

    public function recibir_anular_pago(Request $request)
    {
        #Pendiente: validar estructura de datos recepcionados.
        foreach($request->pago as $anulacion)
        {
            $anulacion_pase_diario = new Anulacion([
                "identificador" => $anulacion->identificador,
                "comprobante" => $anulacion->comprobante,
                "canal_pago_id" => $anulacion->canal_pago_id,
                "fecha_anulacion" => $anulacion->fecha_anulacion,
                "estado" => 0
            ]); 

            $anulacion_pase_diario->save();
        }

        return [
            "status" => "success",
            "message" => "data recibida",
            "code" => 200
        ];

        #Pendiente: Enviar pago a BO, modificar estado de pago de pase diario detalle y pase diario.
    }
}

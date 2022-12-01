<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PaseDiarioCollection;
use App\Http\Resources\PaseDiarioResource;
use App\Models\PaseDiario;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class PasasteSinTagController extends Controller
{
    public function login_pst()
    {
        $params_api = [
            "user" => env('API_PST_USER'),
            "password" => env('API_PST_PASSWORD')
        ];

        $uri = env('API_PST_URL')."login";

        $response = Http::post($uri, $params_api);
        $response = $response->json();

        if($response["status"] == "success")
        {
            return $response;
        } else{
            return $response;
        }
    }

    public function refresh_token_pst()
    {
        $params_api = [
            "token" => "",
        ];

        $uri = env('API_PST_URL')."refresh";

        $response = Http::post($uri, $params_api);

        dd($response->json());

        #Obtener el token
    }

    public function show_pase_diario(PaseDiario $pase_diario) : PaseDiarioResource
    {
        return PaseDiarioResource::make($pase_diario);
    }

    public function index_pases_diarios() : PaseDiarioCollection
    {
        return PaseDiarioCollection::make(PaseDiario::all());
    }

    public function ingreso_deuda_pst()
    {
        #query a base de datos scada. get_transitos_scada()
        #registrar pases diarios en base de datos mysql
        #generar resumen de pases diarios en base de datos mysql

        #leer los pases diarios pendientes de envío y enviarlos a pasastesintag.cl
        $params_api = [
            "identificador" => "",
            "fecha" => "YYYY-MM-DD",
            "patente" => "",
            "deuda" => "",
            "deuda_tag" => "",
            "categoria" => "",
            "tipo_patente" => "",
        ];

        $uri = env('API_PST_URL')."ingreso_deuda";

        $response = Http::post($uri, $params_api);

        dd($response->json());

    }

    #Job planificado cada cierta cantidad de tiempo
    public function get_transitos_scada()
    {

    }

    public function pago_deuda_pasaste_sin_tag()
    {
        $params_api = [
            "comprobante" => "",
            "fecha_pago" => "YYYY-MM-DD",
            "forma_pago_id" => "",
            "pagos" => [
                [
                    "identificador" => "",
                    "monto" => 5000
                ],
                [
                    "identificador" => "",
                    "monto" => 600
                ]

            ],
        ];

        $uri = env('API_PST_URL')."pago_deuda";

        $response = Http::post($uri, $params_api);

        dd($response->json());
  
    }

    public function modificacion_registro_deuda_pasaste_sin_tag()
    {
        $params_api = [
            "identificador" => "",
            "fecha" => "YYYY-MM-DD",
            "patente" => "",
            "deuda" => "",
            "deuda_tag" => "",
            "categoria" => "",
            "tipo_patente" => "",
        ];

        $uri = env('API_PST_URL')."modificacion_deuda_id";

        $response = Http::put($uri, $params_api);

        dd($response->json());
  
    }

    public function eliminar_registro_deuda_pasaste_sin_tag()
    {
        $uri = env('API_PST_URL')."eliminar_deuda_id";

        $params_api = [
            "identificador" => [
                "","",""
            ]
        ];

        $response = Http::delete($uri, $params_api);

        dd($response->json());
   
    }
}

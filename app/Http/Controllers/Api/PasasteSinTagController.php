<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Http\Controllers\Controller;
use App\Http\Resources\PaseDiarioCollection;
use App\Http\Resources\PaseDiarioResource;
use App\Models\Pago;
use App\Models\PaseDiario;
use App\Models\PaseDiarioDetalle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PasasteSinTagController extends Controller
{
    private $pst_host = "https://pasastesintag-qa01.i1.cl/api/";
    private $pst_user = "aconcagua";
    private $pst_password = "da!9No86nXGJ";
    private $pst_token = null;

    private $date_init, $date_end;

    public function login_pst()
    {
        $params_api = [
            "user" => $this->pst_user,
            "password" => $this->pst_password
        ];

        $uri = $this->pst_host."login";

        $response = Http::withToken($this->pst_token)->post($uri, $params_api);
        $response = $response->json();

        if($response["status"] == "success")
        {
            $this->pst_token = $response["data"]["token"];
            return $response["data"];
        } else{
            return $response;
        }
    }

    public function refresh_token_pst()
    {
        if(is_null($this->pst_token))
        {
            $this->login_pst();
        }

        $params_api = [
            "token" => $this->pst_token,
        ];

        $uri = $this->pst_host."refresh";

        $response = Http::post($uri, $params_api);
        $response = $response->json();

        if($response["status"] == "success")
        {
            $this->pst_token = $response["data"]["token"];
            return $response["data"];
        } else{
            return $response;
        }
    }

    public function show_pase_diario(PaseDiario $pase_diario) : PaseDiarioResource
    {
        return PaseDiarioResource::make($pase_diario);
    }

    public function index_pases_diarios() : PaseDiarioCollection
    {
        return PaseDiarioCollection::make(PaseDiario::where('Estado',0));
    }

    public function ingreso_deuda_pst()
    {
        
        $pases_diarios = PaseDiario::where('Estado',0)->limit(2)->get();
        $collector = PaseDiarioCollection::make($pases_diarios);

        return $collector;

        if(is_null($this->pst_token))
        {
            $this->login_pst();
        }

        $uri = $uri = $this->pst_host."ingreso_deuda";

        $response = Http::withToken($this->pst_token)->post($uri, $collector);

        dd($response->json());

        if($response->status() == 201){
            foreach($pases_diarios AS $pase_diario)
            {
                $pase_diario->Estado = 3; // Pase diario informado a pasaste sin tag exitosamente.
                $pase_diario->save();
            }
        }elseif($response->status() == 400)
        {
            foreach($pases_diarios AS $pase_diario)
            {
                $pase_diario->Estado = 3; // Pase diario informado a pasaste sin tag exitosamente.
                $pase_diario->save();
            }

            foreach($response["data"]["errores"] AS $pase_diario_error )
            {
                $pase_diario = PaseDiario::where('Identificador', $pase_diario_error->indetificador);
                $pase_diario->Estado = 10; // Pase dairio reportado con error al cargar deuda.
                $pase_diario->save();
            }
        }elseif($response->status() == 401)
        {
            if(!is_null($this->pst_token))
            {
                $this->refresh_token_pst();
            }

            $response = Http::withToken($this->pst_token)->post($uri, $collector);
        }     

        return $response["data"];

    }

    #Este metodo, prepara los pases diarios agrupados 
    public function get_pases_diarios()
    {
        $this->get_transitos_urbanos();
        $this->get_transitos_interurbanos();

        $pases_diarios = DB::table('pase_diario_detalles')
                ->selectRaw('Identificador,Fecha, Patente, Categoria, COUNT(1) AS CantidadPasesDiarios, SUM(Deuda) AS Deuda, SUM(DeudaTag) AS DeudaTag, 1 AS TipoPatente, 0 AS Estado')
                ->where('Estado',0)
                ->groupBy('Identificador', 'Fecha', 'Patente','Categoria')
                ->get();
        
        foreach($pases_diarios as $pase_diario_agrupado)
        {
            $pase_diario = PaseDiario::where('Identificador',$pase_diario_agrupado->Identificador )->get();

                if($pase_diario->isEmpty())
                {
                    $pase_diario =  new PaseDiario([
                        "Identificador" => $pase_diario_agrupado->Identificador,
                        "Patente" => $pase_diario_agrupado->Patente,
                        "Fecha" => $pase_diario_agrupado->Fecha,
                        "Categoria" => $pase_diario_agrupado->Categoria,
                        "Deuda" => $pase_diario_agrupado->Deuda,
                        "DeudaTag" => $pase_diario_agrupado->DeudaTag,
                        "TipoPatente" => $pase_diario_agrupado->TipoPatente,
                        "Estado" => $pase_diario_agrupado->Estado
                        ]);
                       
                    $pase_diario->save();

                    $affected = DB::table('pase_diario_detalles')
                                ->where('Identificador', $pase_diario->Identificador)
                                ->update(['pase_diario_id' => $pase_diario->id]);
                }
        }
    }

    # Description: Obtener pases diarios urbanos y almacenar.
    #Job planificado cada cierta cantidad de tiempo
    private function get_transitos_urbanos()
    {
        $date = Carbon::now()->subDays(30)->format('Ymd');
        $date_tomorrow = Carbon::tomorrow(1)->subDays(28)->format('Ymd');

        $query_pd_urbano = "SELECT
            '00'+CONVERT(VARCHAR, t.FechaHora, 112)+'12'+RTRIM(LTRIM(dt.Patente)) AS 'Identificador'
            , RTRIM(LTRIM(dt.Patente)) AS 'Patente'
            , CONVERT(VARCHAR, t.FechaHora, 23) AS 'Fecha'
            , dt.ClaseCategoria
            , cc.Descripcion AS 'ClaseCategoriaDescripcion'
            , dt.Categoria
            , c.Descripcion AS 'CategoriaDescripcion'
            , pdf.ImporteRedondeado AS 'Deuda'
	        , SUM(t.Importe)/100 AS 'DeudaTag'
            , MIN(t.NumCorrCA) AS 'NumCorrCA'
        FROM Transitos t (NOLOCK)
            INNER JOIN DetalleTransitos dt (NOLOCK) ON dt.IDDetalleTransito = t.IDDetalleTransito
            INNER JOIN CategoriasClases cc (NOLOCK) ON cc.ID_CategoriasClases = dt.ClaseCategoria
            INNER JOIN Categorias c (NOLOCK) ON c.CodigoCategoria = dt.Categoria AND c.IDCategoriaClase = dt.ClaseCategoria
            INNER JOIN PasesDiariosTarifas pdf (NOLOCK) ON pdf.CodigoCategoria = dt.Categoria AND pdf.IDCategoriaClase = dt.ClaseCategoria AND pdf.AnioVigente = YEAR(t.FechaHoraCreacion)
        WHERE
            t.Estado = 6 
            AND t.NumeroPuntoCobro IN (1,2,3,4,5,6,7,8)
            AND t.FechaHora BETWEEN '$date' AND '$date_tomorrow' 
        GROUP BY 
            '00'+CONVERT(VARCHAR, t.FechaHora, 112)+'12'+RTRIM(LTRIM(dt.Patente))
            , dt.Patente  
            , CONVERT(VARCHAR, t.FechaHora, 23)
            , dt.ClaseCategoria 
            , cc.Descripcion 
            , dt.Categoria 
            , c.Descripcion 
            , pdf.ImporteRedondeado 
        HAVING
            Patente <> '' AND ((LEN(Patente) IN (5) AND Categoria = 4) OR (LEN(Patente) IN (6))) 
            ORDER BY dt.Patente ASC, CONVERT(VARCHAR, t.FechaHora, 23) ASC, dt.Categoria DESC";
        
        try
        {
            $pases_diarios_urbanos = DB::connection('sqlsrv')->select($query_pd_urbano);
            $pases_diarios_urbanos = collect($pases_diarios_urbanos)->unique(['Identificador']);
            
            foreach($pases_diarios_urbanos as $pase_diario_urbano)
            {
                $pase_diario = PaseDiarioDetalle::where('NumCorrCA',$pase_diario_urbano->NumCorrCA )->get();

                if($pase_diario->isEmpty())
                {
                    $pase_diario =  new PaseDiarioDetalle([
                        "Identificador" => $pase_diario_urbano->Identificador,
                        "Patente" => $pase_diario_urbano->Patente,
                        "Fecha" => $pase_diario_urbano->Fecha,
                        "ClaseCategoria" => $pase_diario_urbano->ClaseCategoria,
                        "ClaseCategoriaDescripcion" => $pase_diario_urbano->ClaseCategoriaDescripcion,
                        "Categoria" => $pase_diario_urbano->Categoria,
                        "CategoriaDescripcion" => $pase_diario_urbano->CategoriaDescripcion,
                        "Deuda" => $pase_diario_urbano->Deuda,
                        "DeudaTag" => $pase_diario_urbano->DeudaTag,
                        "NumCorrCA" => $pase_diario_urbano->NumCorrCA,
                        "Estado" => 0
                        ]);
                       
                        $pase_diario->save();
                }
            }
            return 'success';

        } catch (Exception $e)
        {
            return 'Hay un error';
        }
    }

    # Description: Obtener pases diarios interurbanos y almacenar.
    #Job planificado cada cierta cantidad de tiempo
    private function get_transitos_interurbanos()
    {
        $date = Carbon::now()->subDays(30)->format('Ymd');
        $date_tomorrow = Carbon::tomorrow(1)->subDays(28)->format('Ymd');

        $query_pd_interurbano = "SELECT
            '00'+CONVERT(VARCHAR, t.FechaHora, 112)+'12'+RTRIM(LTRIM(dt.Patente)) AS 'Identificador'
            , RTRIM(LTRIM(dt.Patente)) AS 'Patente' 
            , CONVERT(VARCHAR, t.FechaHora, 23) AS 'Fecha'
            , dt.ClaseCategoria 
            , cc.Descripcion AS 'ClaseCategoriaDescripcion' 
            , CASE 
                WHEN dt.Categoria = 1 THEN 4 
                WHEN dt.Categoria = 2 THEN 1 
                WHEN dt.Categoria = 3 THEN 1 
                WHEN dt.Categoria = 4 THEN 2 
                WHEN dt.Categoria = 5 THEN 2 
                WHEN dt.Categoria = 6 THEN 3 
                WHEN dt.Categoria = 7 THEN 3 
                ELSE 1 
            END AS 'Categoria' 
            , c.Descripcion AS 'CategoriaDescripcion' 
            , pdf.ImporteRedondeado AS 'Deuda'
	        , SUM(t.Importe)/100 AS 'DeudaTag'
            , MIN(t.NumCorrCA) AS 'NumCorrCA'
        FROM Transitos t (NOLOCK) 
            INNER JOIN DetalleTransitos dt (NOLOCK) ON dt.IDDetalleTransito = t.IDDetalleTransito 
            INNER JOIN CategoriasClases cc (NOLOCK) ON cc.ID_CategoriasClases = dt.ClaseCategoria 
            INNER JOIN Categorias c (NOLOCK) ON c.CodigoCategoria = dt.Categoria AND c.IDCategoriaClase = dt.ClaseCategoria 
            INNER JOIN PasesDiariosTarifas pdf (NOLOCK) ON pdf.CodigoCategoria = dt.Categoria AND pdf.IDCategoriaClase = dt.ClaseCategoria AND pdf.AnioVigente = YEAR(t.FechaHoraCreacion)
        WHERE 
            t.Estado = 6 
            AND t.NumeroPuntoCobro IN (9,10)
            AND t.FechaHora BETWEEN '$date' AND '$date_tomorrow'
        GROUP BY
            '00'+CONVERT(VARCHAR, t.FechaHora, 112)+'12'+RTRIM(LTRIM(dt.Patente))
            , dt.Patente  
            , CONVERT(VARCHAR, t.FechaHora, 23) 
            ,t.FechaHora
            , dt.ClaseCategoria
            , cc.Descripcion
            , dt.Categoria
            , c.Descripcion
            , pdf.ImporteRedondeado 
        HAVING
            dt.Patente <> ''
            AND ((LEN(dt.Patente) IN (5) AND Categoria = 4) OR (LEN(dt.Patente) IN (6)))
        ORDER BY dt.Patente ASC, CONVERT(VARCHAR, t.FechaHora, 23) ASC, dt.Categoria DESC";

     try {

        $pases_diarios_interurbanos = DB::connection('sqlsrv')->select($query_pd_interurbano);
        $pases_diarios_interurbanos = collect($pases_diarios_interurbanos);

        foreach($pases_diarios_interurbanos as $pase_diario_interurbano)
            {
                $pase_diario = PaseDiarioDetalle::where('NumCorrCA',$pase_diario_interurbano->NumCorrCA )->get();

                if($pase_diario->isEmpty())
                {
                    $pase_diario =  new PaseDiarioDetalle([
                        "Identificador" => $pase_diario_interurbano->Identificador,
                        "Patente" => $pase_diario_interurbano->Patente,
                        "Fecha" => $pase_diario_interurbano->Fecha,
                        "ClaseCategoria" => $pase_diario_interurbano->ClaseCategoria,
                        "ClaseCategoriaDescripcion" => $pase_diario_interurbano->ClaseCategoriaDescripcion,
                        "Categoria" => $pase_diario_interurbano->Categoria,
                        "CategoriaDescripcion" => $pase_diario_interurbano->CategoriaDescripcion,
                        "Deuda" => $pase_diario_interurbano->Deuda,
                        "DeudaTag" => $pase_diario_interurbano->DeudaTag,
                        "NumCorrCA" => $pase_diario_interurbano->NumCorrCA,
                        "Estado" => 0
                        ]);
                       
                        $pase_diario->save();
                }
            }

            return 'success';

     } catch (Exception $e) {
        return 'Hay un error';
     }

    }

    #Description: Generado desde interfaz grafica.
    public function pago_deuda_pasaste_sin_tag(Request $request)
    {
        $params_api = [
            "comprobante" => (string) $request->comprobante,
            "forma_pago_id" => (int) $request->forma_pago_id,
            "fecha_pago" => (string) $request->fecha_pago,
            
            "pagos" => [
                $request->pases_diarios
            ],
        ];

        $uri = env('API_PST_URL')."pago_deuda";

        $response = Http::post($uri, $params_api);

        $response = $response->json();

        if($response->status() == 200)
        {
            foreach($request->pases_diarios AS $pase_diario)
            {
                $pase_diario->Estado = 10; // Pase diario informado a pasaste sin tag como pagado exitosamente.
                $pase_diario->save();
            }
            return $response->json();
        }else{
            return $response->json();
        }
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

    public function eliminar_registro_deuda_pasaste_sin_tag(Request $request)
    {
        $uri = $this->pst_host."eliminar_deuda_id";

        $pase_diario = PaseDiario::where('Identificador',$request->identificador);
        $pase_diario->Estado = 99; # Solicitar eliminación de deuda
        $pase_diario->save();

        if(!$pase_diario->isEmpty())
        {
            $params_api = [
                "identificador" => [$request->identificador]
            ];
    
            $response = Http::delete($uri, $params_api);

            if($response->successful())
            {
                $pase_diario->Estado = 100; # Informar que deuda ya fue eliminada de pasastesintag.cl
                $pase_diario->save();
                return response()->json($data = [
                    'mensaje' => 'Deuda eliminada con exito'
                ], $status = 200);
            } else {
                return response()->json($data = [
                    'mensaje' => 'Deuda no pudo ser eliminada de pasastesintag.cl'
                ], $status = 404);
            }

        } else {
            return response()->json($data = [
                'mensaje' => 'No existe deuda en nuestro sistema acerca de este identificador: '.$request->identificador
            ], $status = 404); 
        }  
    }

    public function anular_pago(Request $request)
    {
        $uri = $this->pst_host."anular_pago";

        $pago = Pago::where('Comprobante',$request->comprobante);
        $pago->Estado = 80; # Solicitar anulación de pago en pasastesintag, debido a que Recaudador no informo pago en rendicion
        $pago->save();

        if(!$pago->isEmpty())
        {
            $params_api = [
                "comprobante" => [$request->comprobante]
            ];
    
            $response = Http::post($uri, $params_api);

            if($response->successful())
            {
                $pago->Estado = 81; # Pago anulado en pasastesintag, pasediario disponible para volver a cobrar
                $pago->save();
                return response()->json($data = [
                    'mensaje' => 'Comprobante de pago anulado con exito'
                ], $status = 200);
            } else {
                return response()->json($data = [
                    'mensaje' => 'Comprobante de pago no pudo ser anulado en pasastesintag.cl'
                ], $status = 404);
            }

        } else {
            return response()->json($data = [
                'mensaje' => 'No existe comprobante de pago en nuestro sistema acerca de este comprobante: '.$request->comprobante
            ], $status = 404); 
        }  
    }

}

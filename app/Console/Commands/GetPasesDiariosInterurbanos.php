<?php

namespace App\Console\Commands;

use App\Models\PaseDiarioDetalle;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Exception;
use Illuminate\Support\Facades\DB;

class GetPasesDiariosInterurbanos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pasesdiariosinterurbanos:get';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $date = Carbon::now()->subDays(30)->format('Ymd');
        $date_tomorrow = Carbon::tomorrow(1)->subDays(28)->format('Ymd');

        $query_pd_interurbano = "SELECT
            '00'+CONVERT(VARCHAR, t.FechaHora, 112)+'12'+'0000'+RTRIM(LTRIM(dt.Patente)) AS 'Identificador'
            , '0000' + CAST(RTRIM(LTRIM(dt.Patente)) AS VARCHAR) AS 'Patente' 
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
            , t.FechaHora
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

            return Command::SUCCESS;

     } catch (Exception $e) {
        return Command::FAILURE;
     }

    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PaseDiarioDetalle;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Exception;

class GetPasesDiariosUrbanos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pasesdiariosurbanos:get';

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

        $query_pd_urbano = "SELECT
            '00'+CONVERT(VARCHAR, t.FechaHora, 112)+'12'+'0000'+RTRIM(LTRIM(dt.Patente)) AS 'Identificador'
            , '0000' + CAST(RTRIM(LTRIM(dt.Patente)) AS VARCHAR) AS 'Patente'
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
            , t.FechaHora
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
            return Command::SUCCESS;

     } catch (Exception $e) {
        return Command::FAILURE;
    }
    }
}

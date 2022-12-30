<?php

namespace App\Console\Commands;

use App\Models\PaseDiario;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class GetPasesDiarios extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pasesdiarios:get';

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
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaseDiarioDetalle extends Model
{
    use HasFactory;

    protected $fillable = [
        'Identificador',
        'Patente',
        'Fecha',
        'ClaseCategoria',
        'ClaseCategoriaDescripcion',
        'Categoria',
        'CategoriaDescripcion',
        'Deuda',
        'DeudaTag',
        'NumCorrCA',
        'Estado',
        'pase_diario_id'
    ];

    protected $casts = [
        'Fecha'  => 'date:YY-MM-DD',
    ];
}

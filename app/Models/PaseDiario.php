<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaseDiario extends Model
{
    use HasFactory;

    protected $fillable = [
        'Identificador',
        'Patente',
        'Fecha',
        'Categoria',
        'CategoriaDescripcion',
        'Deuda',
        'DeudaTag',
        'Estado',
        'FechaInformadoPST',
        'TipoPatente'
    ];

    protected $casts = [
        'Fecha'  => 'date:YY-MM-DD',
        'FechaInformadoPST' => 'datetime'
    ];

}

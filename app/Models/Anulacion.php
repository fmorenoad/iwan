<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anulacion extends Model
{
    use HasFactory;

    protected $table = "anulaciones";

    protected $fillable = [
        'identificador',
        'comprobante',
        'fecha_anulacion',
        'canal_pago_id',
        'estado',
        'user_id'
    ];

    
}

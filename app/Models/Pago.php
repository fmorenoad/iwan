<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $fillable = [
        'identificador',
        'monto',
        'comprobante',
        'fecha_pago',
        'canal_pago_id',
        'forma_pago_id',
        'estado',
        'user_id'
    ];
}

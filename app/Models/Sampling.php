<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sampling extends Model
{
    use HasFactory;

    protected $fillable = [
        'gross_sample',
        'net_sample',
        'ingress_humidity',
        'receipt_id',
        'user_id'
    ];

}

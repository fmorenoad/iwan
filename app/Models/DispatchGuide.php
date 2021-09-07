<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DispatchGuide extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'kg',
        'season',
        'receipt_id'
    ];
}

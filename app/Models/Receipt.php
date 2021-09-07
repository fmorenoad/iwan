<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket',
        'enterprise_id',
        'plot_id',
        'farmer_id',
        'kg_income',
        'end_of_plot',
        'plot_departure_date',
        'entry_date',
        'ppu',
        'season',
        'user_id'
    ];

    protected $dates = [
        'plot_departure_date',
        'entry_date'
    ];

    public function dispatch_guide()
    {
        return $this->hasOne(DispatchGuide::class);
    }

    public function enterprise()
    {
        return $this->belongsTo(Enterprise::class, 'enterprise_id', 'id');
    }

    public function plot()
    {
        return $this->belongsTo(Plot::class);
    }

    public function farmer()
    {
        return $this->belongsTo(Farmer::class);
    }

    public function sampling()
    {
        return $this->hasOne(Sampling::class);
    }
}

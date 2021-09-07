<?php

namespace App\Http\Livewire\Receipt;

use App\Models\Farmer;
use App\Models\Plot;
use Livewire\Component;

class PlotShow extends Component
{
    public $code;

    public function render()
    {
        $plot = Plot::select('plot', 'id')->where([['code','=',strval($this->code)],['season','=',intval(date('Y'))]])->first();
        if(!is_null($plot))
        {
            $plot = Plot::find($plot->id);
        }
        return view('livewire.receipt.plot-show', ['plot' => $plot]);
    }
}

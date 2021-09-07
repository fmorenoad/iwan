<?php

namespace App\Http\Controllers\BO;

use App\Http\Controllers\Controller;
use App\Models\DispatchGuide;
use App\Models\Enterprise;
use App\Models\Receipt;
use App\Models\Sampling;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    private $activePage = 'Receipt';
    private $activeButton = 'receipt';
    private $navName = 'Receipt';
    private $title = 'Receipt';
    private $subtitle = 'Recepción';

    public function index()
    {
        return view('bo.receipt.index',[
            'activePage' => $this->activePage,
            'activeButton' => $this->activeButton,
            'navName' => $this->navName,
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'receipts' => Receipt::all(),
        ]);
    }

    public function create()
    {
        $enterprise = auth()->user()->enterprise;

        return view('bo.receipt.create',[
            'activePage' => $this->activePage,
            'activeButton' => $this->activeButton,
            'navName' => $this->navName,
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'enterprises' => Enterprise::all()
        ]);
    }

    public function store(Request $request)
    {

        $receipt = Receipt::create([
            'user_id' => auth()->user()->id,
            'plot_departure_date' => date("Y-m-d H:i", strtotime($request->plot_departure_date)),
            'entry_date' => date("Y-m-d H:i", strtotime($request->entry_date)),
            'ticket' => $request->ticket,
            'enterprise_id' => $request->enterprise_id,
            'plot_id' => $request->plot_id,
            'farmer_id' => $request->farmer_id,
            'kg_income' => $request->kg_income,
            'end_of_plot' => $request->end_of_plot,
            'ppu' => $request->ppu,
            'season' => intval(date('Y')),
            ]);

        $dispatch_guide = DispatchGuide::create([
            'number' => $request->dispatch_guide,
            'kg' => $request->kg_dispatch_guide,
            'season' => intval(date('Y')),
            'receipt_id' => $receipt->id,
        ]);

        return redirect()->route('receipt.index')->with('message', 'Ingreso registrado con éxito!');
    }

    public function show(Receipt $receipt)
    {
        return view('bo.receipt.show',[
            'activePage' => $this->activePage,
            'activeButton' => $this->activeButton,
            'navName' => $this->navName,
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'receipt' => $receipt
        ]);
    }

    public function create_sampling(Receipt $receipt)
    {
        return view('bo.receipt.sampling.create',[
            'activePage' => $this->activePage,
            'activeButton' => $this->activeButton,
            'navName' => $this->navName,
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'receipt' => $receipt
        ]);
    }

    public function store_sampling(Receipt $receipt,Request $request)
    {
        $sampling = Sampling::create([
            'gross_sample' => $request->gross_sample,
            'net_sample' => $request->net_sample,
            'ingress_humidity' => $request->ingress_humidity,
            'user_id' => auth()->user()->id,
            'receipt_id' => $receipt->id,
            ]);

        return redirect()->route('receipt.index')->with('message', 'Muestras registradas con éxito!');
    }

    public function update_sampling(Receipt $receipt, Sampling $sampling, Request $request)
    {
        $sampling->update([
            'gross_sample' => $request->gross_sample,
            'net_sample' => $request->net_sample,
            'ingress_humidity' => $request->ingress_humidity,
        ]);

        return redirect()->route('receipt.show', ['receipt' => $receipt->id])->with('message', 'Muestras editada con éxito!');
    }
}

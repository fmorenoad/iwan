<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EntryControlController extends Controller
{
    private $activePage = 'EntryControl';
    private $activeButton = 'entry_control';
    private $navName = 'Entry Control';
    private $title = 'Entry Control';
    private $subtitle = 'Control de Ingreso';

    public function index()
    {
        return view('bo.entry_control.index',[
            'activePage' => $this->activePage,
            'activeButton' => $this->activeButton,
            'navName' => $this->navName,
            'title' => $this->title,
            'subtitle' => $this->subtitle,
        ]);
    }
}

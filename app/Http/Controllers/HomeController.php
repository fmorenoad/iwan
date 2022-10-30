<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public $info_page = [
        'activePage' => 'home', 
        'activeButton' => 'home', 
        'title' => 'home', 
        'navName' => 'home'
    ];

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {        
        return view('home', [
            'info_page' => $this->info_page
        ]);
    }
}

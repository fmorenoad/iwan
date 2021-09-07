<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enterprise;
use Illuminate\Http\Request;

class EnterpriseController extends Controller
{
    private $activePage = 'Enterprise';
    private $activeButton = 'admin';
    private $navName = 'enterprise';
    private $title = 'Enterprise Management';
    private $subtitle = 'Gestión de Empresas';

    public function index()
    {
        $enterprises = Enterprise::all();

        return view('admins.enterprises.index',[
            'activePage' => $this->activePage,
            'activeButton' => $this->activeButton,
            'navName' => $this->navName,
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'enterprises' => $enterprises
        ]);
    }

    public function create()
    {
        return view('admins.enterprises.create',[
            'activePage' => $this->activePage,
            'activeButton' => $this->activeButton,
            'navName' => $this->navName,
            'title' => $this->title,
            'subtitle' => $this->subtitle,
        ]);
    }

    public function store(Request $request)
    {
        $enterprise = Enterprise::create($request->all());

        return redirect()->route('enterprises.index')->with('messages', 'Empresa creada con éxito!');
    }

    public function update(Request $request, Enterprise $enterprise)
    {
        $enterprise->update([$request->all()]);

        return redirect()->route('enterprises.index')->with('message', 'Empresa actualizada con éxito!');
    }

    public function edit(Enterprise $enterprise)
    {
        return view('admins.enterprises.edit',[
            'activePage' => $this->activePage,
            'activeButton' => $this->activeButton,
            'navName' => $this->navName,
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'enterprise' => $enterprise
        ]);
    }

    public function destroy(Enterprise $enterprise)
    {
        $enterprise->delete();

        return back()->with('messages', 'Empresa eliminada con éxito!');
    }
}

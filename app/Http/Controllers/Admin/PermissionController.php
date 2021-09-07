<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    private $activePage = 'Permissions';
    private $activeButton = 'admin';
    private $navName = 'Permissions';
    private $title = 'Permissions Management';
    private $subtitle = 'Gestión de Permisos';

    public function index()
    {
        $permissions = Permission::all();

        return view('admins.permissions.index',[
            'activePage' => $this->activePage,
            'activeButton' => $this->activeButton,
            'navName' => $this->navName,
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'permissions' => $permissions
        ]);
    }

    public function create()
    {
        return view('admins.permissions.create',[
            'activePage' => $this->activePage,
            'activeButton' => $this->activeButton,
            'navName' => $this->navName,
            'title' => $this->title,
            'subtitle' => $this->subtitle,
        ]);
    }

    public function store(Request $request)
    {
        $permission = Permission::create([
            'name' => $request->controller.'.'.$request->action,
            'guard_name' => $request->guard_name
        ]);

        return redirect()->route('permissions.index')->with('message', 'Permiso '.$permission.' creado con éxito');
    }

    public function destroy(Permission $permission, Request $request)
    {
        $permission->delete();
        return redirect()->route('permissions.index')->with('message', 'Permiso eliminado con éxito');
    }
}

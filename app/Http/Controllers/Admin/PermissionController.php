<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    private $title = 'Administración';
    private $subtitle = 'Gestión de Permisos';

    public function index()
    {
        $permissions = Permission::all();

        return view('admin.permission.index',[
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'permissions' => $permissions
        ]);
    }

    public function create()
    {
        return view('admin.permission.create',[
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

        return redirect()->route('permission.index')->with('message', 'Permiso '.$permission.' creado con éxito');
    }

    public function destroy(Permission $permission, Request $request)
    {
        $permission->delete();
        return back()->with('message', 'Permiso eliminado con éxito');
    }
}

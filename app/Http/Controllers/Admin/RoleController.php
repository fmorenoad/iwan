<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    private $title = 'Administración';
    private $subtitle = 'Gestión de Roles';

    public function index()
    {
        $roles = Role::all();

        return view('admin.role.index',[
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'roles' => $roles
        ]);
    }

    public function create()
    {
        $permissions = Permission::all();

        return view('admin.role.create',[
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'permissions' => $permissions
        ]);
    }

    public function store(Request $request)
    {
        $role = Role::create([
            'name' => $request->name,
            'guard_name' => $request->guard_name
        ]);

        $role->givePermissionTo($request->permissions);

        return redirect()->route('role.index')->with('message', 'Rol '.$role.' creado con éxito');
    }

    public function destroy(Role $role, Request $request)
    {
        $role->delete();
        return back()->with('message', 'Rol eliminado con éxito');
    }
}

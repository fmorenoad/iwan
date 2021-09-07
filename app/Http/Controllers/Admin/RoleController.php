<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    private $activePage = 'roles';
    private $activeButton = 'admin';
    private $navName = 'roles';
    private $title = 'Roles Management';
    private $subtitle = 'Gestión de Roles';

    public function index()
    {
        $roles = Role::all();

        return view('admins.roles.index',[
            'activePage' => $this->activePage,
            'activeButton' => $this->activeButton,
            'navName' => $this->navName,
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'roles' => $roles
        ]);
    }

    public function create()
    {
        $permissions = Permission::all();

        return view('admins.roles.create',[
            'activePage' => $this->activePage,
            'activeButton' => $this->activeButton,
            'navName' => $this->navName,
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

        return redirect()->route('roles.index')->with('message', 'Rol '.$role.' creado con éxito');
    }

    public function destroy(Role $role, Request $request)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('message', 'Rol eliminado con éxito');
    }
}

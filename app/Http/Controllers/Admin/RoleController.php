<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public $info_page = [
        'activePage' => 'admin', 
        'activeButton' => 'roles', 
        'title' => 'Roles', 
        'navName' => 'Roles'
    ];
    
    public function index()
    {
        $roles = Role::all();
        /*$permissions = DB::table('permissions')->get();
        $role_has_permissions = DB::table('role_has_permissions')->get();*/

        return view('admin.roles.index', [
            'info_page' => $this->info_page,
            'roles' => $roles,
        ]);
    }

    public function create()
    {
        return view('admin.roles.create', [
            'info_page' => $this->info_page,
        ]);
    }

    public function store(Request $request)
    {
        $role = Role::create(['name' => $request->role, 'guard_name' => 'web']);
        return redirect(route('admin.roles.index'))->with('status','Rol creado con exito');
    }

    public function edit(Role $role)
    {

        $role_has_permissions = DB::table('role_has_permissions')
            ->leftJoin('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
            ->where('role_id',$role->id)
            ->get();

        $permissions = DB::table('permissions')
            ->get();

        return view('admin.roles.edit', [
            'info_page' => $this->info_page,
            'role' => $role, 
            'role_has_permissions' => $role_has_permissions, 
            'permissions' => $permissions
        ]);
    }

    public function update(Request $request, Role $role)
    {
        $permissions_of_role = DB::table('role_has_permissions')
            ->select('permissions.id', 'permissions.name')
            ->leftJoin('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
            ->where('role_id',$role->id)
            ->get();

        #Quitar permisos actuales
        foreach ($permissions_of_role as $permission) {
            $role->revokePermissionTo($permission->name);
        }

        $list_permissions = DB::table('permissions')->get();

        #Identificar nuevos permisos y armar un array.
        foreach($list_permissions as $permission) {
            $permission->name_clave = str_replace('.','_',$permission->name);
            if(isset($request[$permission->name_clave]))
            {
                $role->givePermissionTo([$permission->name]);
            }
        }

        return redirect(route('admin.roles.index'))->with('status', 'Permisos asignados con éxito');
    }

    public function destroy(Request $request, Role $role)
    {
        $role->delete();
        return redirect(route('admin.roles.index'))->with('status', 'Rol eliminado con éxito');
    }
}

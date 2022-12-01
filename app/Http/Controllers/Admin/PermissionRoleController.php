<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionRoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        /*$permissions = DB::table('permissions')->get();
        $role_has_permissions = DB::table('role_has_permissions')->get();*/

        return view('admin.roles.index', compact(['roles']));
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(Request $request)
    {
        Role::create(['name' => $request->role]);
        return back()->with('status','Rol creado con exito');
    }

    public function storePermission (Request $request)
    {

        Permission::create(['name' => $request->permission, 'guard_name' => 'web']);
        return back()->with('status','Permiso creado con exito');
    }

    public function edit(Role $role)
    {

        $role_has_permissions = DB::table('role_has_permissions')
            ->leftJoin('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
            ->where('role_id',$role->id)
            ->get();

        $permissions = DB::table('permissions')
            ->get();

        return view('admin.roles.edit', compact(['role', 'role_has_permissions', 'permissions']));
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

        return redirect(route('roles.index'))->with('status', 'Permisos asignados con éxito');
    }
}

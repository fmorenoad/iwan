<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public $info_page = [
        'activePage' => 'admin', 
        'activeButton' => 'permissions', 
        'title' => 'Permissions', 
        'navName' => 'Permissions'
    ];
    
    public function index()
    {
        $permissions = Permission::all();

        return view('admin.permissions.index', [
            'info_page' => $this->info_page,
            'permissions' => $permissions,

        ]);
    }

    public function create()
    {
        return view('admin.permissions.create',[
            'info_page' => $this->info_page,
        ]);
    }

    public function store (Request $request)
    {
        $permission = Permission::create(['name' => $request->permission, 'guard_name' => 'web']);

        return redirect(route('admin.permissions.index'))->with('status','Permiso creado con exito');
    }

    public function edit(Permission $permission)
    {

        $role_has_permissions = DB::table('role_has_permissions')
            ->leftJoin('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
            ->where('permission_id',$permission->id)
            ->get();

        $permissions = DB::table('permissions')
            ->get();

        return view('admin.permissions.edit', [
            'info_page' => $this->info_page,
            'permission' => $permission , 
            'role_has_permissions' => $role_has_permissions, 
            'permissions' => $permissions
        ]);
    }

    public function update(Request $request, Permission $permission)
    {
        /*$permission->name = $request->permission;*/
        $permission->update([
            'name' => $request->permission
        ]);

        return redirect(route('admin.permissions.index'))->with('status', 'Permisos editados con éxito');
    }

    public function destroy(Request $request, Permission $permission)
    {
        $permission->delete();
        return redirect(route('admin.permissions.index'))->with('status', 'Permisos eliminado con éxito');
    }
}

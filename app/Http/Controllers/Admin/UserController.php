<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enterprise;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $activePage = 'Users';
    private $activeButton = 'admin';
    private $navName = 'Users';
    private $title = 'Users Management';
    private $subtitle = 'Gestión de Usuarios';

    public function index()
    {
        $users = User::all();

        return view('admins.users.index',[
            'activePage' => $this->activePage,
            'activeButton' => $this->activeButton,
            'navName' => $this->navName,
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'users' => $users
        ]);
    }

    public function create()
    {
        $roles = Role::all();
        $enterprises = Enterprise::all();

        return view('admins.users.create',[
            'activePage' => $this->activePage,
            'activeButton' => $this->activeButton,
            'navName' => $this->navName,
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'roles' => $roles,
            'enterprises' => $enterprises
        ]);
    }

    public function store(Request $request)
    {
        $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        $password = "";

        for($i=0;$i<=8;$i++)
        {
            $password .= substr($str,rand(0,62),1);
        }
        $password = Hash::make($password);

        $user = User::create(['password' => $password] + $request->all());
        $user->assignRole($request->roles);

        return redirect()->route('users.index')->with('messages', 'Usuario creado con éxito!');
    }

    public function update(Request $request, User $user)
    {
        $user->update([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'picture' => $request->picture,
        ]);

        return redirect()->route('profile.edit')->with('message', 'Usuario actualizado con éxito!');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $enterprises = Enterprise::all();

        return view('admins.users.edit',[
            'activePage' => $this->activePage,
            'activeButton' => $this->activeButton,
            'navName' => $this->navName,
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'roles' => $roles,
            'user' => $user,
            'enterprises' => $enterprises
        ]);
    }

    public function update_admin(User $user, Request $request)
    {
        $user->update([
            $request->all()
        ]);

        $roles = $user->getRoleNames();
        foreach($roles as $role)
        {
            $user->removeRole($role);
        }

        $user->assignRole($request->roles);

        return redirect()->route('users.index')->with('message', 'Usuario actualizado con éxito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('messages', 'Usuario eliminado con éxito!');
    }
}

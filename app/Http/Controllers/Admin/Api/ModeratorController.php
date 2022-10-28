<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class ModeratorController extends Controller
{
    public function index()
    {
        $users = User::whereHas('roles', function ($query){
            $query->where('name', 'admin');
        })->get();
        return $users;
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'name'=>'required',
            'password' => 'required|confirmed'
        ]);
        $user = User::create($request->all());
        $user -> password = Hash::make($request->get('password'));
        $user->save();
        $role = Role::findByName('admin');
        $user -> assignRole($role);
        $user->syncPermissions($request->get('permissions_arr'));

        return $user;
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $user->getAllPermissions();
        $permissions = [];
        foreach ($user->permissions as $permission) {
            $permissions[]=$permission['name'];
        }
        $user -> permissions_arr = $permissions;
        return $user;
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
            'name'=>'required',
        ]);

        $user -> update($request->all());
        $user->syncPermissions($request->get('permissions_arr'));
        return $user;
    }

    public function delete()
    {

    }

}

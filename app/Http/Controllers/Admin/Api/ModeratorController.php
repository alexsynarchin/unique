<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
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
        $role = Role::findByName('admin');
        $user -> assignRole($role);
        return $user;
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
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
        return $user;
    }

    public function delete()
    {

    }

}

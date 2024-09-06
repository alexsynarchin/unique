<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Laravue\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);
        return $user;
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id
        ], [

        ]);
        $user = User::findOrFail($id);
    }
    public function changePassword($id, Request $request)
    {

        $request->validate([
            'password' => 'required|confirmed|min:6'
        ]);
        $user = User::findOrFail($id);

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user -> update([
            'password' => $input['password']
        ]);
        return 'Пароль изменен';
    }
}

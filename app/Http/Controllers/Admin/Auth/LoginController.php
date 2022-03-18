<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('admin.auth.login');
    }
    public function handleLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);
        $user = User::where('email', $request->get('email'))->first();
        if (Auth::attempt($credentials) && $user -> hasRole('admin')) {
            $request->session()->regenerate();
            return route('admin.home');
            //return redirect()->intended('dashboard');
        }
        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }
    public function logout()
    {
        Auth::logout();
        return route('home');
    }
}

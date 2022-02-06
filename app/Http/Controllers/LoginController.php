<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    public function login(LoginRequest $request)
    {
        if (Auth::attempt(['login' => $request->input('Login'),
                'password' => $request->input('Password')])) {
            $request->session()->regenerate();
            return redirect(route('admin.admin'));
        } else {
            return redirect(route('admin.login'))->withErrors([
                'Login' => 'Wrong login or password'
            ]);
        }
    }

    public function registration(LoginRequest $request)
    {
        $admin = Admin::insertOrIgnore([
            'login' => $request->input('Login'),
            'password' => Hash::make($request->input('Password'))
        ]);

        if ($admin) {
            Auth::attempt(['login' => $request->input('Login'),
                'password' => $request->input('Password')]);
            $request->session()->regenerate();
            return redirect(route('admin.admin'));
        } else {
            return redirect(route('admin.registration'))->withErrors([
                'Login' => 'Username already exists'
            ]);
        }
    }
}

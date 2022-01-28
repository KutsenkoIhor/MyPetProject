<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function settings () {
//        $dataUrl = DB::table('news_urls')
//            ->orderBy('updated_at', 'desc')
//            ->select('id', 'url', 'created_at', 'updated_at')
//            ->get();
//
//        return view('page/settings', ['data' => $dataUrl]);
        return view('layouts/test');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('admin.login'));
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt(['login' => $request->input('Login'),
                'password' => $request->input('Password')])) {
            $request->session()->regenerate();
            return redirect(route('admin.admin'));
        } else {
            return redirect(route('admin.login'))->withErrors([
                'Login' => 'Неверный логин или пароль'
            ]);
        }
    }

    public function registration(LoginRequest $request)
    {
        $admin = DB::table('admins')->insertOrIgnore([
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
                'Login' => 'Произошла ошибка при сохранении пользователя'
            ]);
        }
    }
}

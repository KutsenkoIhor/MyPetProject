<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function pageAuth()
    {
        return view('page/authorization');
    }

    public function login(LoginRequest $request)
    {
//        $validated = $request->validate([
//            'Login'=>'required|min:4|max:50',
//            'Password'=>'required|min:6|max:50'
//        ]);

    }
}

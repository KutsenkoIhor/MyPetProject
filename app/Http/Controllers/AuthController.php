<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function pageAuth()
    {
        return view('page/authorization');
    }

    public function login()
    {
//        return "fd";
        return dd(Request::all());
    }
}

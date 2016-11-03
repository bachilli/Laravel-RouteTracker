<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function __construct()
    {
        // ...
    }

    public function index()
    {
        return view('auth.login');
    }
}
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

/**
 * Classe que realiza o registro do usuário.
 *
 * @package App\Http\Controllers\Auth
 */
class RegisterController extends Controller
{
    public function __construct()
    {
        // ...
    }

    public function index()
    {
        return view('auth.register');
    }
}
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

/**
 * Classe que realiza a autenticação do usuário.
 *
 * @package App\Http\Controllers\Auth
 */
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
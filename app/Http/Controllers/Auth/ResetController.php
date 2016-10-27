<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

/**
 * Classe que realiza a mudança de senha.
 *
 * @package App\Http\Controllers\Auth
 */
class ResetController extends Controller
{
    public function __construct()
    {
        // ...
    }

    public function index()
    {
        return view('auth.reset');
    }
}
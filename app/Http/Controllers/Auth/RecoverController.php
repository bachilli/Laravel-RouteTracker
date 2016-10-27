<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

/**
 * Classe que realiza a recuperação de senha do usuário.
 *
 * @package App\Http\Controllers\Auth
 */
class RecoverController extends Controller
{
    public function __construct()
    {
        // ...
    }

    public function index()
    {
        return view('auth.recover');
    }
}
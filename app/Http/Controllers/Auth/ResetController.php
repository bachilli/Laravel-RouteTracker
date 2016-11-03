<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class ResetController extends Controller
{
    /**
     * ...
     *
     * @return void
     */
    public function __construct()
    {
        // ...
    }

    public function index()
    {
        return view('auth.reset');
    }
}
<?php

namespace App\Http\Controllers\CPanel;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Construtor do controlador principal do painel de controle.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view('cpanel.dashboard.index');
    }
}
<?php

namespace App\Http\Controllers\CPanel;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

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

    /**
     * ...
     *
     * @return View
     */
    public function index()
    {
        return view('cpanel.dashboard.index');
    }
}
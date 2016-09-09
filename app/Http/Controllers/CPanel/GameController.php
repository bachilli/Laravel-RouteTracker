<?php

use App\Http\Controllers\Controller;

class GameController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view('cpanel.games.index');
    }
}
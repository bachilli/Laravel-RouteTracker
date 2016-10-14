<?php

namespace App\Http\Controllers\Primary;

use App\Http\Controllers\Controller;

class GameController extends Controller
{
    public function index()
    {
        return view('primary.games.single');
    }
}
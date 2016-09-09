<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;

class TagController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view('cpanel.tags.index');
    }
}
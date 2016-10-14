<?php

namespace App\Http\Controllers\CPanel;

use App\Http\Controllers\Controller;
use App\Models\SourceContent;

class SourceContentController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $sourceContents = SourceContent::all();

        return view('cpanel.source-contents.index', compact('sourceContents'));
    }

    public function show()
    {

    }

    public function create()
    {

    }

    public function store()
    {

    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
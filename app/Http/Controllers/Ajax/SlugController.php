<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class SlugController extends Controller
{
    /**
     * Torna uma string "amigável" ao sistema.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $response = [ 'success' => false ];

        if (! $request->ajax()) Response::json($response, 400);

        $response = [
            'success' => true,
            'str' => str_slug(
                $request->input('str')
            )
        ];

        return Response::json($response);
    }
}
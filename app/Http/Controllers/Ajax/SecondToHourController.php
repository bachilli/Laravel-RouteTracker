<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class SecondToHourController extends Controller
{
    /**
     * Transforma segundos em hora.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $response = null;

        if (! $request->ajax()) Response::json($response, 400);

        $seconds = $request->input('seconds');

        $response = gmdate('H:i:s', $seconds);

        return Response::json($response);
    }
}
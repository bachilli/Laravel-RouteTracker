<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class BaseRequest extends FormRequest
{
    /**
     * ...
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
}
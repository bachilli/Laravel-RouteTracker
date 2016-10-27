<?php

namespace App\Http\Requests\CPanel\Tag;

use App\Http\Requests\Request;

class TagUpdateRequest extends Request
{
    /**
     * O usuário é autorizado a realizar está requisição?
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Regras de validação aplicadas na requisição.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }
}
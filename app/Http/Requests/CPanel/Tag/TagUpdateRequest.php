<?php

namespace App\Http\Requests\CPanel\Category;

use App\Http\Requests\Request;

class CategoryUpdateRequest extends Request
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

    /**
     * Filtragem e tratamento dos inputs.
     *
     * @return array
     */
    public function all()
    {
        $input = (object) parent::all();

        $input->slug = prep($input->name)->slug();

        return (array) $input;
    }
}
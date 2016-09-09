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
        return rule_builder()
            ->input('name')->required()
            ->input('slug')->nullable()
            ->input('description')->nullable()
            ->rules();
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
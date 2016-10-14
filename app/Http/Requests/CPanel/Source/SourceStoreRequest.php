<?php

namespace App\Http\Requests\CPanel\Game;

use App\Http\Requests\Request;
use GSMeira\LaravelRuleBuilder\LaravelRuleBuilder;

class GameStoreRequest extends Request
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
     * @param LaravelRuleBuilder $validate
     * @return array
     */
    public function rules(LaravelRuleBuilder $validate)
    {
        $validate->input('name')->required();
        $validate->input('slug')->nullable();
        $validate->input('description')->nullable();

        return $validate->rules();
    }

    /**
     * Filtragem e tratamento dos inputs.
     *
     * @return array
     */
    public function all()
    {
        $input = (object) parent::all();

        // $input->slug = prep($input->name)->slug();

        return (array) $input;
    }
}
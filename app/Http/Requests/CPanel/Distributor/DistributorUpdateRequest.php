<?php

namespace App\Http\Requests\CPanel\Distributor;

use App\Http\Requests\Request;
use GSMeira\LaravelRuleBuilder\LaravelRuleBuilder;

class DistributorUpdateRequest extends Request
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
}
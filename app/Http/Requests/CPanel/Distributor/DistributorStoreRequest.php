<?php

namespace App\Http\Requests\CPanel\Distributor;

use App\Http\Requests\BaseRequest;
use GSMeira\LaravelRuleBuilder\LaravelRuleBuilder;

class DistributorStoreRequest extends BaseRequest
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
        $validate->input('slug')->present();
        $validate->input('description')->present();

        return $validate->rules();
    }
}
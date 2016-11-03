<?php

namespace App\Http\Requests\CPanel\Tag;

use GSMeira\LaravelRuleBuilder\LaravelRuleBuilder;

class TagStoreRequest extends TagRequest
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
        $validate->input('name')->present()->required();
        $validate->input('slug')->present();
        $validate->input('excerpt')->present();
        $validate->input('description')->present();
        $validate->input('thumbnail')->present();
        $validate->input('is_visible')->present()->in(0, 1);

        return $validate->rules();
    }
}
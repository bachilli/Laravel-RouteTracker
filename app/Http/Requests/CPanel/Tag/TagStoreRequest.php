<?php

namespace App\Http\Requests\CPanel\Tag;

use App\Http\Requests\Request;
use GSMeira\LaravelRuleBuilder\LaravelRuleBuilder;

class TagStoreRequest extends Request
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
        $validate->input('description')->nullable();
        $validate->input('thumbnail')->uplab_required('image')
            ->uplab_size('max=10MB')
            ->uplab_dimensions('min_width=800,min_height=600')
            ->uplab_mimes('jpg,png,gif');

        return $validate->rules();
    }
}
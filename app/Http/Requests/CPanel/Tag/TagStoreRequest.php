<?php

namespace App\Http\Requests\CPanel\Category;

use App\Http\Requests\Request;
use GSMeira\LaravelRuleBuilder\LaravelRuleBuilder;

class CategoryStoreRequest extends Request
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
        $validate->input('thumbnail')->uplab_required('image')
            ->uplab_size('max=10MB')
            ->uplab_dimensions('min_width=800,min_height=600')
            ->uplab_mimes('jpg,png,gif');

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

        $input->slug = prep($input->name)->slug();

        return (array) $input;
    }
}
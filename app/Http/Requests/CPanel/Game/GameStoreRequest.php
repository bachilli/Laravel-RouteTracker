<?php

namespace App\Http\Requests\CPanel\Game;

use App\Http\Requests\Request;
use GSMeira\LaravelRuleBuilder\LaravelRuleBuilder;

class GameStoreRequest extends Request
{
    /**
     * O usuário é autorizado a realizar a criação de um jogo?
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Regras de validação aplicadas na criação de um jogo.
     *
     * @param LaravelRuleBuilder $validate
     * @return array
     */
    public function rules(LaravelRuleBuilder $validate)
    {
        $validate->input('name')->present()->required();
        $validate->input('excerpt')->present();
        $validate->input('description')->present();
        $validate->input('instructions')->present();
        $validate->input('width')->present()->integer();
        $validate->input('height')->present()->integer();
        $validate->input('aspect_ratio')->present()->numeric();
        $validate->input('age_range')->present()->in('L', '10', '12', '14', '16', '18');
        $validate->input('embed_src')->present()->url();
        $validate->input('embed_type')->present()->in('INSIDE', 'OUTSIDE');
        $validate->input('file')->present();
        $validate->input('thumbnail')->present();
        $validate->input('is_visible')->present()->in(0, 1);
        $validate->input('published_at')->present();

        return $validate->rules();
    }

    /**
     * Filtragem e tratamento dos inputs de criação dos jogos.
     *
     * @return array
     */
    public function all()
    {
        $input = (object) parent::all();

        return (array) $input;
    }
}
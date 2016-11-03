<?php

namespace App\Http\Requests\CPanel\Game;

use GSMeira\LaravelRuleBuilder\LaravelRuleBuilder;

class GameStoreRequest extends GameRequest
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
        $validate->input('slug')->present();
        $validate->input('excerpt')->present();
        $validate->input('description')->present();
        $validate->input('instructions')->present();
        $validate->input('age_range')->present()->in('NOT_SPECIFIED', 'L', '10', '12', '14', '16', '18');
        $validate->input('distributor_id')->present()->integer()->exists('distributors', 'id');
        $validate->input('dimensions.width')->present()->integer();
        $validate->input('dimensions.height')->present()->integer();
        $validate->input('dimensions.aspect_ratio')->present()->numeric();
        $validate->input('dimensions.is_responsive')->present()->in(0, 1);
        $validate->input('embed.url')->present()->url();
        $validate->input('embed.type')->present()->in('INSIDE', 'OUTSIDE');
        // $validate->input('file')->present();
        $validate->input('thumbnail')->present();
        $validate->input('published_at')->present();
        $validate->input('is_visible')->present()->in(0, 1);

        return $validate->rules();
    }
}
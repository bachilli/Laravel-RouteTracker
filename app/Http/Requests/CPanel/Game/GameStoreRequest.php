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
        $validate->input('published_at')->present();
        $validate->input('name')->present()->required();
        $validate->input('excerpt')->present();
        $validate->input('description')->present();
        $validate->input('instructions')->present();
        $validate->input('width')->present()->integer();
        $validate->input('height')->present()->integer();
        $validate->input('aspect_ratio')->present()->float();
        $validate->input('classification')->present()->in('L', '10', '12', '14', '16', '18');
        $validate->input('type')->present()->in('FLASH', 'SHOCKWAVE', 'UNITY3D', 'HTML5');
        $validate->input('embed_src')->present()->url();
        $validate->input('embed_type')->present()->in('INTERNAL', 'EXTERNAL');
        $validate->input('file')->present();
        $validate->input('thumbnail')->present();
        $validate->input('is_published')->present()->in(0, 1);

        return $validate->rules();
    }
}
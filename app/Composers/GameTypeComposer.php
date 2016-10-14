<?php

namespace App\Composers;

class GameTypeComposer
{
    public function compose($view)
    {
        $gameTypes = [
            'FLASH' => 'FLASH',
            'SHOCKWAVE' => 'SHOCKWAVE',
            'UNITY3D' => 'UNITY3D',
            'HTML5' => 'HTML5'
        ];

        $view->with('gameTypes', $gameTypes);
    }
}
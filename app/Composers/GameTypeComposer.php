<?php

namespace App\Composers;

class GameTypeSelectComposer
{
    public function compose($view)
    {
        $types = [
            'FLASH' => 'FLASH',
            'SHOCKWAVE' => 'SHOCKWAVE',
            'UNITY3D' => 'UNITY3D',
            'HTML5' => 'HTML5'
        ];

        $view->with('types', $types);
    }
}
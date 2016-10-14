<?php

namespace App\Composers;

class GameEmbedTypeComposer
{
    public function compose($view)
    {
        $gameEmbedTypes = [
            'INTERNAL' => 'Interno',
            'EXTERNAL' => 'Externo'
        ];

        $view->with('gameEmbedTypes', $gameEmbedTypes);
    }
}
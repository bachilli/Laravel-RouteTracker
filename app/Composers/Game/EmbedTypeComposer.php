<?php

namespace App\Composers\Game;

class EmbedTypeComposer
{
    public function compose($view)
    {
        $embedType = [
            'INSIDE' => 'Interno',
            'OUTSIDE' => 'Externo'
        ];

        $view->with('embedType', $embedType);
    }
}
<?php

namespace App\Composers;

class EmbedTypeComposer
{
    public function compose($view)
    {
        $embedTypes = [
            'INTERNAL' => 'Interno',
            'EXTERNAL' => 'Externo'
        ];

        $view->with('embedTypes', $embedTypes);
    }
}
<?php

namespace App\Composers\Game;

class EmbedTypeComposer
{
    public function compose($view)
    {
        $embedType = [
            'INSIDE' => __('general.inside'),
            'OUTSIDE' => __('general.outside')
        ];

        $view->with('embedType', $embedType);
    }
}
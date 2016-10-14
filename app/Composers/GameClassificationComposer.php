<?php

namespace App\Composers;

class GameClassificationSelectComposer
{
    public function compose($view)
    {
        $classifications = [
            'L' => 'L',
            '10' => 10,
            '12' => 12,
            '14' => 14,
            '16' => 16,
            '18' => 18
        ];

        $view->with('classifications', $classifications);
    }
}
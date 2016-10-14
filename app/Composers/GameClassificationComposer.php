<?php

namespace App\Composers;

class GameClassificationComposer
{
    public function compose($view)
    {
        $gameClassifications = [
            'L' => 'L',
            '10' => '10',
            '12' => '12',
            '14' => '14',
            '16' => '16',
            '18' => '18'
        ];

        $view->with('gameClassifications', $gameClassifications);
    }
}
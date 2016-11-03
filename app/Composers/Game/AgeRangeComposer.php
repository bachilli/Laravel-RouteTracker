<?php

namespace App\Composers\Game;

class AgeRangeComposer
{
    public function compose($view)
    {
        $ageRange = [
            'NOT_SPECIFIED' => __('general.not_specified'),
            'L' => 'L',
            '10' => '10',
            '12' => '12',
            '14' => '14',
            '16' => '16',
            '18' => '18'
        ];

        $view->with('ageRange', $ageRange);
    }
}
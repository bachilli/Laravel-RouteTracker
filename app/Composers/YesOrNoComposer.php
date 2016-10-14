<?php

namespace App\Composers;

class YesOrNoComposer
{
    public function compose($view)
    {
        $yesOrNo = [
            '1' => 'Sim',
            '0' => 'Não'
        ];

        $view->with('yesOrNo', $yesOrNo);
    }
}
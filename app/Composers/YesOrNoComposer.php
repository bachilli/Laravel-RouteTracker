<?php

namespace App\Composers;

class YesOrNoComposer
{
    public function compose($view)
    {
        $yesOrNo = [
            '1' => trans('general.yes'),
            '0' => trans('general.no')
        ];

        $view->with('yesOrNo', $yesOrNo);
    }
}
<?php

namespace App\Composers;

class YesOrNoComposer
{
    /**
     * ...
     *
     * @param $view
     */
    public function compose($view)
    {
        $yesOrNo = [
            '1' => __('general.yes'),
            '0' => __('general.no')
        ];

        $view->with('yesOrNo', $yesOrNo);
    }
}
<?php

namespace App\Http\Requests\CPanel\Tag;

use App\Http\Requests\BaseRequest;

class TagRequest extends BaseRequest
{
    /**
     * Filtragem e tratamento dos inputs.
     *
     * @return array
     */
    public function all()
    {
        $input = (object) parent::all();

        $input->name = sys_val($input->name)->title();
        $input->slug = sys_val($input->slug)->slug($input->name);
        $input->thumbnail = str_empty($input->thumbnail) ? '' : uplab($input->thumbnail)->getObject();
        $input->is_visible = str_empty($input->is_visible) ? true : $input->is_visible;

        return (array) $input;
    }
}
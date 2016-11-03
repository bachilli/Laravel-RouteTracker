<?php

namespace App\Http\Requests\CPanel\Game;

use App\Http\Requests\BaseRequest;
use Carbon\Carbon;

class GameRequest extends BaseRequest
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
        $input->age_range = str_empty($input->age_range) ? 'NOT_SPECIFIED' : $input->age_range;
        $input->dimensions['is_responsive'] = str_empty($input->dimensions['is_responsive']) ? true : $input->dimensions['is_responsive'];
        $input->embed['type'] = str_empty($input->embed['type']) ? 'INSIDE' : $input->embed['type'];
        // $input->file = str_empty($input->file) ? '' : uplab($input->file)->getObject();
        $input->thumbnail = str_empty($input->thumbnail) ? '' : uplab($input->thumbnail)->getObject();
        $input->published_at = str_empty($input->human_published_at) ? Carbon::now() : $input->published_at;
        $input->is_visible = str_empty($input->is_visible) ? true : $input->is_visible;

        return (array) $input;
    }
}
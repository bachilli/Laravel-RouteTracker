<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    /**
     * Campos nulos da tabela.
     *
     * @var array
     */
    protected $nullable = [];

    /**
     * Campos do tipo uplab da tabela.
     *
     * @var array
     */
    protected $uplab = [];

    /**
     * Executa toda vez que um novo registro é salvo no BD.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function($model) {
            // Define os campos nulos.
            foreach ($model->nullable as $field) {
                if (str_empty($model->{$field})) {
                    $model->{$field} = null;
                }
            }

            // Define os campos do tipo uplab.
            foreach ($model->uplab as $field) {
                if (! empty($model->{$field})) {
                    $model->{$field} = [
                        'name' => $model->{$field}->name,
                        'dir' => str_replace('_uplab/', '', $model->{$field}->dir),
                        'location' => str_replace('_uplab/', '', $model->{$field}->location)
                    ];
                }
            }
        });
    }
}
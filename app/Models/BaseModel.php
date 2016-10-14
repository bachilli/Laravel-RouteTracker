<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseModel
 *
 * @package App\Acme\Models
 */
class BaseModel extends Model
{
    /**
     * Campos nulos da tabela.
     *
     * @var array
     */
    protected $nullable = [];

    /**
     * Executa toda vez que um novo registro é salvo no BD.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function($model) {
            self::setNullables($model);
        });
    }

    /**
     * Atribui "null" aos campos que podem ser nulos.
     *
     * @param object $model
     * @return void
     */
    protected static function setNullables($model)
    {
        foreach ($model->nullable as $field) {
            if ($model->{$field} === '') $model->{$field} = null;
        }
    }
}
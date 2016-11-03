<?php

namespace App\Models;

class Distributor extends BaseModel
{
    /**
     * Nome da tabela usada pelo modelo.
     *
     * @var string
     */
    protected $table = 'distributors';

    /**
     * Campos permitidos na atribuição em massa.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug'
    ];
}
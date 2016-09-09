<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CentralJogosCategory extends Model
{
    /**
     * Nome da tabela usada pelo modelo.
     *
     * @var string
     */
    protected $table = 'centraljogos_categories';

    /**
     * Campos permitidos na atribuição em massa.
     *
     * @var array
     */
    protected $fillable = [ 'name', 'slug', 'url' ];
}
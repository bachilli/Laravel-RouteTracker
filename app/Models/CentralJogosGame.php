<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CentralJogosGame extends Model
{
    /**
     * Nome da tabela usada pelo modelo.
     *
     * @var string
     */
    protected $table = 'centraljogos_games';

    /**
     * Campos permitidos na atribuição em massa.
     *
     * @var array
     */
    protected $fillable = [ 'name', 'slug', 'classification', 'url' ];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SourceContent extends Model
{
    /**
     * Nome da tabela usada pelo modelo.
     *
     * @var string
     */
    protected $table = 'source_entries';

    /**
     * Campos permitidos na atribuição em massa.
     *
     * @var array
     */
    protected $fillable = [
        'key', 'source_id', 'name', 'type', 'status', 'data'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'data' => 'array'
    ];
}
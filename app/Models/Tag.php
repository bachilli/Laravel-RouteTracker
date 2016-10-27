<?php

namespace App\Models;

class Tag extends BaseModel
{
    /**
     * Nome da tabela usada pelo modelo.
     *
     * @var string
     */
    protected $table = 'tags';

    /**
     * Campos permitidos na atribuição em massa.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'thumbnail',
        'published_at',
        'is_visible'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'thumbnail' => 'array',
        'is_visible' => 'integer'
    ];
}
<?php

namespace App\Models;

class Game extends BaseModel
{
    /**
     * Nome da tabela usada pelo modelo.
     *
     * @var string
     */
    protected $table = 'games';

    /**
     * Campos permitidos na atribuição em massa.
     *
     * @var array
     */
    protected $fillable = [
        'published_at',
        'name',
        'slug',
        'excerpt',
        'description',
        'instructions',
        'dimensions',
        'classification',
        'type',
        'embed',
        'is_published',
        'file',
        'thumbnail'
    ];

    /**
     * Campos nulos da tabela.
     *
     * @var array
     */
    protected $nullable = [
        'published_at',
        'excerpt',
        'description',
        'instructions',
        'dimensions',
        'classification',
        'type',
        'embed',
        'is_published',
        'file',
        'thumbnail'
    ];

    /**
     * Atributos que devem ser tratadas como data.
     *
     * @var array
     */
    protected $dates = [ 'published_at' ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'embed' => 'object',
        'instructions' => 'object',
        'dimensions' => 'object',
        'file' => 'object',
        'thumbnail' => 'object'
    ];
}
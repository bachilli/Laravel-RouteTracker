<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'excerpt',
        'description',
        'thumbnail',
        'icon',
        'is_visible'
    ];

    /**
     * Atributos que devem ser convertidos para seus tipos nativos.
     *
     * @var array
     */
    protected $casts = [
        'thumbnail' => 'array',
        'is_visible' => 'integer'
    ];

    /**
     * Retorna as tags associadas aos jogos.
     *
     * @return belongsTo
     */
    public function games()
    {
        return $this->belongsToMany(Game::class, 'categorizations')
            ->withTimestamps()
            ->orderBy('name', 'ASC');
    }
}
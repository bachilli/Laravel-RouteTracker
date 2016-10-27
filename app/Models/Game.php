<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
        'name',
        'slug',
        'excerpt',
        'description',
        'instructions',
        'dimensions',
        'age_range',
        'embed',
        'is_visible',
        'file',
        'thumbnail',
        'published_at'
    ];

    /**
     * Campos nulos da tabela.
     *
     * @var array
     */
    protected $nullable = [
        'excerpt',
        'description',
        'instructions',
        'dimensions',
        'age_range',
        'embed',
        'file',
        'thumbnail',
        'published_at',
        'is_visible'
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
        'thumbnail' => 'object',
        'is_visible' => 'integer'
    ];

    /**
     * Retorna as tags associadas aos jogos.
     *
     * @return BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'categorizations')
            ->withTimestamps()
            ->orderBy('name', 'ASC');
    }
}
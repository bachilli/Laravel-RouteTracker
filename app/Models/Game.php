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
        'distributor_id',
        'name',
        'slug',
        'excerpt',
        'description',
        'instructions',
        'dimensions',
        'age_range',
        'embed',
        'is_visible',
        'thumbnail',
        'published_at'
    ];

    /**
     * Campos nulos da tabela.
     *
     * @var array
     */
    protected $nullable = [
        'distributor_id',
        'excerpt',
        'description',
        'instructions',
        'dimensions',
        'age_range',
        'embed',
        'is_visible',
        'thumbnail'
    ];

    /**
     * Atributos que devem ser tratadas como data.
     *
     * @var array
     */
    protected $dates = [ 'published_at' ];

    /**
     * Atributos que devem ser convertidos para seus tipos nativos.
     *
     * @var array
     */
    protected $casts = [
        'embed' => 'object',
        'instructions' => 'object',
        'dimensions' => 'object',
        'thumbnail' => 'object',
        'is_visible' => 'integer'
    ];

    /**
     * Campos do tipo uplab da tabela.
     *
     * @var array
     */
    protected $uplab = [
        'thumbnail'
    ];

    /**
     * Retorna a lista de tags associadas ao artigo.
     *
     * @return array
     */
    public function getTagListAttribute()
    {
        return $this->tags->pluck('id')->toArray();
    }

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
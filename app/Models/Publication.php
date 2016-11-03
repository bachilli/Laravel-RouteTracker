<?php

namespace App\Models;

class Publication extends BaseModel
{
    /**
     * Nome da tabela usada pelo modelo.
     *
     * @var string
     */
    protected $table = 'publications';

    /**
     * Campos permitidos na atribuição em massa.
     *
     * @var array
     */
    protected $fillable = [
        'key',
        'distributor_id',
        'name',
        'type',
        'status',
        'data'
    ];

    /**
     * Atributos que devem ser convertidos para seus tipos nativos.
     *
     * @var array
     */
    protected $casts = [
        'data' => 'array'
    ];

    /**
     * Retorna a fonte associada ao conteúdo.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function distributor()
    {
        return $this->belongsTo(Distributor::class);
    }
}
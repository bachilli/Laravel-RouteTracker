<?php

namespace App\Repositories\SourceContent;

class EloquentSourceContentRepository implements SourceContentRepository
{
    /**
     * Retorna todos os anúncios existentes.
     *
     * @param array $columns
     * @return mixed
     */
    public function getAll($columns = [ '*' ])
    {
        return Tag::latest('created_at')->get($columns);
    }

    /**
     * Retorna todos os anúncios fazendo uso da paginação.
     *
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function getPaging($perPage = 15, $columns = [ '*' ])
    {
        return Tag::latest('id')->paginate($perPage, $columns);
    }
}
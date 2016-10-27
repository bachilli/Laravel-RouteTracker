<?php

namespace App\Repositories\Publication;

use App\Models\Publication;

class EloquentPublicationRepository implements PublicationRepository
{
    /**
     * Retorna todos os conteúdos das fontes existentes.
     *
     * @param array $columns
     * @return mixed
     */
    public function getAll($columns = [ '*' ])
    {
        return Publication::latest('created_at')->get($columns);
    }

    /**
     * Retorna todos os conteúdos das fontes fazendo uso da paginação.
     *
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function getPaging($perPage = 15, $columns = [ '*' ])
    {
        return Publication::latest('created_at')->paginate($perPage, $columns);
    }

    /**
     * Retorna os conteúdos das fontes encontrados para uma dada busca.
     *
     * @param $q
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function findByQuery($q, $perPage = 15, $columns = [ '*' ])
    {
        return Publication::where('name', 'ILIKE', '%'.$q.'%')
            ->orWhere('description', 'ILIKE', '%'.$q.'%')
            ->latest('created_at')
            ->paginate($perPage, $columns)
            ->appends([ 'q' => $q ]);
    }

    /**
     * Retorna o conteúdo de uma dada fonte através do campo ID.
     *
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function findById($id, $columns = [ '*' ])
    {
        return Publication::find($id, $columns);
    }
}
<?php

namespace App\Repositories\Category;

use App\Models\Category;

class EloquentCategoryFetchRepository implements CategoryFetchRepository
{
    /**
     * Retorna todos os anúncios existentes.
     *
     * @param array $columns
     * @return mixed
     */
    public function getAll($columns = [ '*' ])
    {
        return Category::latest('created_at')->get($columns);
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
        return Category::latest('id')->paginate($perPage, $columns);
    }

    /**
     * Retorna os anúncios encontrados para uma dada busca.
     *
     * @param $q
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function findByQuery($q, $perPage = 15, $columns = [ '*' ])
    {
        return Category::where('name', 'ILIKE', '%'.$q.'%')
            ->orWhere('code', 'ILIKE', '%'.$q.'%')
            ->latest('created_at')
            ->paginate($perPage, $columns)
            ->appends([ 'q' => $q ]);
    }

    /**
     * Retorna um dado anúncio através do campo ID.
     *
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function findById($id, $columns = [ '*' ])
    {
        return Category::find($id, $columns);
    }
}
<?php

namespace App\Repositories\Publication;

use App\Models\Publication;
use Exception;
use Illuminate\Support\Facades\DB;

class EloquentPublicationRepository implements PublicationRepository
{
    /**
     * Retorna todas as publicações existentes.
     *
     * @param array $columns
     * @return Publication
     */
    public function getAll($columns = [ '*' ])
    {
        return Publication::latest('id')->latest('created_at')->get($columns);
    }

    /**
     * Retorna todas as publicações fazendo uso da paginação.
     *
     * @param int $perPage
     * @param array $columns
     * @return Publication
     */
    public function getPaging($perPage = 15, $columns = [ '*' ])
    {
        return Publication::latest('id')->latest('created_at')->paginate($perPage, $columns);
    }

    /**
     * Retorna as publicações encontradas para uma dada busca.
     *
     * @param $q
     * @param int $perPage
     * @param array $columns
     * @return Publication
     */
    public function findByQuery($q, $perPage = 15, $columns = [ '*' ])
    {
        return Publication::where('name', 'ILIKE', '%'.$q.'%')
            ->orWhere('description', 'ILIKE', '%'.$q.'%')
            ->latest('id')
            ->latest('created_at')
            ->paginate($perPage, $columns)
            ->appends([ 'q' => $q ]);
    }

    /**
     * Retorna uma dada publicação através do campo ID.
     *
     * @param $id
     * @param array $columns
     * @return Publication
     */
    public function findById($id, $columns = [ '*' ])
    {
        return Publication::find($id, $columns);
    }

    /**
     * Retorna uma dada publicação através do distribuidor.
     *
     * @param $distributorId
     * @param $type
     * @param array $columns
     * @return Publication
     */
    public function findByDistributorId($distributorId, $type, $columns = [ '*' ])
    {
        return Publication::where('distributor_id', $distributorId)
            ->where('type', $type)
            ->get();
    }

    /**
     * Verifica se uma dada publicação já existe.
     *
     * @param $key
     * @param $distributorId
     * @param $type
     * @return Publication|null
     */
    public function exists($key, $distributorId, $type)
    {
        return Publication::where('key', $key)
            ->where('distributor_id', $distributorId)
            ->where('type', $type)->first();
    }

    /**
     * Cria uma nova publicação.
     *
     * @param $values
     * @return Publication|null
     * @throws Exception
     */
    public function store($values)
    {
        $publication = $this->exists(
            $values['key'],
            $values['distributor_id'],
            $values['type']
        );

        if (! empty($publication)) {
            return $publication;
        }

        DB::beginTransaction();

        try {
            $publication = Publication::create($values);

            DB::commit();

            return $publication;
        } catch (Exception $e) {
            DB::rollback();

            return show_debug($e);
        }
    }
}
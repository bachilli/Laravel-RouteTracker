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
    public function getOnly($columns = [ '*' ])
    {
        return Publication::get($columns);
    }

    /**
     * Retorna todas as publicações fazendo uso da paginação.
     *
     * @param array $columns
     * @return Publication
     */
    public function getAndPage($columns = [ '*' ])
    {
        return Publication::paginate($this->limit, $columns);
    }

    /**
     * Retorna as publicações encontradas para uma dada busca.
     *
     * @param $q
     * @param array $columns
     * @return Publication
     */
    public function searchOnly($q, $columns = [ '*' ])
    {
        return Publication::where('name', 'ILIKE', '%'.$q.'%')
            ->orWhere('description', 'ILIKE', '%'.$q.'%')
            ->paginate($this->limit, $columns)
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
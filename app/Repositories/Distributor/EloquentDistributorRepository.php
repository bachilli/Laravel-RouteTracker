<?php

namespace App\Repositories\Distributor;

use App\Models\Distributor;
use Exception;
use Illuminate\Support\Facades\DB;

class EloquentDistributorRepository implements DistributorRepository
{
    /**
     * Retorna todas as fontes de conteúdo existentes.
     *
     * @param array $columns
     * @return mixed
     */
    public function getAll($columns = [ '*' ])
    {
        return Distributor::latest('created_at')->get($columns);
    }

    /**
     * Retorna todas as fontes de conteúdo fazendo uso da paginação.
     *
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function getPaging($perPage = 15, $columns = [ '*' ])
    {
        return Distributor::latest('created_at')->paginate($perPage, $columns);
    }

    /**
     * Retorna as fontes de conteúdo encontradas para uma dada busca.
     *
     * @param $q
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function findByQuery($q, $perPage = 15, $columns = [ '*' ])
    {
        return Distributor::where('name', 'ILIKE', '%'.$q.'%')
            ->orWhere('description', 'ILIKE', '%'.$q.'%')
            ->latest('created_at')
            ->paginate($perPage, $columns)
            ->appends([ 'q' => $q ]);
    }

    /**
     * Retorna uma dada fonte de conteúdo através do campo ID.
     *
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function findById($id, $columns = [ '*' ])
    {
        return Distributor::find($id, $columns);
    }

    /**
     * Cria uma nova fonte de conteúdo.
     *
     * @param $values
     * @return Distributor|bool
     * @throws Exception
     */
    public function store($values)
    {
        DB::beginTransaction();

        try {
            $distributor = Distributor::create([
                'name' => $values['name'],
                'slug' => sys_val($values['name'])->slug(),
                'description' => $values['description'],
                'thumbnail' => sys_val($values['thumbnail'])->uplab()
            ]);

            DB::commit();

            uplab($values['thumbnail'])->persist($distributor->thumbnail);

            return $distributor;
        } catch (Exception $e) {
            DB::rollback();

            if (env('APP_DEBUG')) throw $e;

            return false;
        }
    }

    /**
     * Realiza a atualização de uma fonte de conteúdo.
     *
     * @param $values
     * @param $distributor
     * @return Distributor|bool
     * @throws Exception
     */
    public function update($values, $distributor)
    {
        DB::beginTransaction();

        try {
            $previous = (object) [ 'thumbnail' => $distributor->thumbnail ];

            $distributor->update([
                'name' => $values['name'],
                'slug' => sys_val($values['name'])->slug(),
                'description' => $values['description'],
                'thumbnail' => sys_val($values['thumbnail'])->uplab()
            ]);

            DB::commit();

            uplab($values['thumbnail'])->persist($distributor->thumbnail, $previous->thumbnail);

            return true;
        } catch (Exception $e) {
            DB::rollback();

            if (env('APP_DEBUG')) throw $e;

            return false;
        }
    }

    /**
     * Faz a exclusão de uma fonte de conteúdo.
     *
     * @param $distributor
     * @return Distributor|bool
     * @throws Exception
     */
    public function destroy($distributor)
    {
        DB::beginTransaction();

        try {
            $distributor->delete();

            DB::commit();

            storage()->deleteDirectory($distributor->thumbnail->dir);

            return $distributor;
        } catch (Exception $e) {
            DB::rollback();

            if (env('APP_DEBUG')) throw $e;

            return false;
        }
    }
}
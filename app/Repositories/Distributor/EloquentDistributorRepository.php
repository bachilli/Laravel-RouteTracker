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
     * @return Distributor
     */
    public function getAll($columns = [ '*' ])
    {
        return Distributor::latest('id')->latest('created_at')->get($columns);
    }

    /**
     * Retorna todas as fontes de conteúdo fazendo uso da paginação.
     *
     * @param int $perPage
     * @param array $columns
     * @return Distributor
     */
    public function getPaging($perPage = 15, $columns = [ '*' ])
    {
        return Distributor::latest('id')->latest('created_at')->paginate($perPage, $columns);
    }

    /**
     * Retorna as fontes de conteúdo encontradas para uma dada busca.
     *
     * @param $q
     * @param int $perPage
     * @param array $columns
     * @return Distributor
     */
    public function findByQuery($q, $perPage = 15, $columns = [ '*' ])
    {
        return Distributor::where('name', 'ILIKE', '%'.$q.'%')
            ->orWhere('description', 'ILIKE', '%'.$q.'%')
            ->latest('id')
            ->latest('created_at')
            ->paginate($perPage, $columns)
            ->appends([ 'q' => $q ]);
    }

    /**
     * Retorna uma dada fonte de conteúdo através do campo ID.
     *
     * @param $id
     * @param array $columns
     * @return Distributor
     */
    public function findById($id, $columns = [ '*' ])
    {
        return Distributor::find($id, $columns);
    }

    /**
     * Cria uma nova fonte de conteúdo.
     *
     * @param $values
     * @return Distributor|null
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

            return show_debug($e);
        }
    }

    /**
     * Realiza a atualização de uma fonte de conteúdo.
     *
     * @param $values
     * @param $distributor
     * @return Distributor|null
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

            return $distributor;
        } catch (Exception $e) {
            DB::rollback();

            return show_debug($e);
        }
    }

    /**
     * Faz a exclusão de uma fonte de conteúdo.
     *
     * @param $distributor
     * @return Distributor|null
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

            return show_debug($e);
        }
    }
}
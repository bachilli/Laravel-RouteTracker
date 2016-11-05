<?php

namespace App\Repositories\Distributor;

use App\Models\Distributor;
use Exception;
use Illuminate\Support\Facades\DB;

class EloquentDistributorRepository implements DistributorRepository
{
    /**
     * Retorna todas as distribuidoras existentes.
     *
     * @param array $columns
     * @return Distributor
     */
    public function getOnly($columns = [ '*' ])
    {
        return Distributor::get($columns);
    }

    /**
     * Retorna todas as distribuidoras fazendo uso da paginação.
     *
     * @param array $columns
     * @return Distributor
     */
    public function getAndPage($columns = [ '*' ])
    {
        return Distributor::paginate($this->limit, $columns);
    }

    /**
     * Retorna as distribuidoras para uma dada busca.
     *
     * @param $q
     * @param array $columns
     * @return Distributor
     */
    public function searchOnly($q, $columns = [ '*' ])
    {
        return Distributor::where('name', 'ILIKE', '%'.$q.'%')
            ->orWhere('description', 'ILIKE', '%'.$q.'%')
            ->paginate($this->limit, $columns)
            ->appends([ 'q' => $q ]);
    }

    /**
     * Retorna uma distribuidora através do campo ID.
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
     * Cria uma nova distribuidora.
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
     * Realiza a atualização de uma distribuidora.
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
     * Faz a exclusão de uma distribuidora.
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
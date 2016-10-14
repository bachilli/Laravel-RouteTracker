<?php

namespace App\Repositories\Source;

use App\Models\Source;
use Exception;
use Illuminate\Support\Facades\DB;

class EloquentSourceRepository implements SourceRepository
{
    /**
     * Retorna todas as fontes de conteúdo existentes.
     *
     * @param array $columns
     * @return mixed
     */
    public function getAll($columns = [ '*' ])
    {
        return Source::latest('created_at')->get($columns);
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
        return Source::latest('id')->paginate($perPage, $columns);
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
        return Source::where('name', 'ILIKE', '%'.$q.'%')
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
        return Source::find($id, $columns);
    }

    /**
     * Cria uma nova fonte de conteúdo.
     *
     * @param $values
     * @return Source|bool
     * @throws Exception
     */
    public function store($values)
    {
        DB::beginTransaction();

        try {
            $sysVal = sys_val($values);

            $source = Source::create([
                'name' => $values['name'],
                'slug' => $sysVal->slug('name'),
                'description' => $values['description'],
                'thumbnail' => $sysVal->uplab('thumbnail')
            ]);

            DB::commit();

            uplab($values['thumbnail'])->persist($source->thumbnail);

            return $source;
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
     * @param $source
     * @return Source|bool
     * @throws Exception
     */
    public function update($values, $source)
    {
        DB::beginTransaction();

        try {
            $sysVal = sys_val($values);

            $previous = (object) [ 'thumbnail' => $source->thumbnail ];

            $source->update([
                'name' => $values['name'],
                'slug' => $sysVal->slug('name'),
                'description' => $values['description'],
                'thumbnail' => $sysVal->uplab('thumbnail')
            ]);

            DB::commit();

            uplab($values['thumbnail'])->persist($source->thumbnail, $previous->thumbnail);

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
     * @param $source
     * @return Source|bool
     * @throws Exception
     */
    public function destroy($source)
    {
        DB::beginTransaction();

        try {
            $source->delete();

            DB::commit();

            storage()->deleteDirectory($source->thumbnail->dir);

            return $source;
        } catch (Exception $e) {
            DB::rollback();

            if (env('APP_DEBUG')) throw $e;

            return false;
        }
    }
}
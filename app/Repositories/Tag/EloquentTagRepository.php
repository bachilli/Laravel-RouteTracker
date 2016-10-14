<?php

namespace App\Repositories\Tag;

use App\Models\Tag;

class EloquentTagRepository implements TagRepository
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
        return Tag::where('name', 'ILIKE', '%'.$q.'%')
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
        return Tag::find($id, $columns);
    }

    /**
     * Cria uma nova tag.
     *
     * @param $values
     * @return Tag|bool
     * @throws Exception
     */
    public function store($values)
    {
        DB::beginTransaction();

        try {
            $tag = Tag::create([
                'name' => $values['name'],
                'slug' => $values['slug'],
                'description' => $values['description'],
                'thumbnail' => prep($values['thumbnail'])->uplab()
            ]);

            DB::commit();

            uplab($values['thumbnail'])->persist($tag->thumbnail->location);

            return $tag;
        } catch (Exception $e) {
            DB::rollback();

            if (env('APP_DEBUG')) throw $e;

            return false;
        }
    }

    /**
     * Realiza a atualização de uma tag.
     *
     * @param $values
     * @param $tag
     * @return Tag|bool
     * @throws Exception
     */
    public function update($values, $tag)
    {
        DB::beginTransaction();

        try {
            $previous = (object) [ 'thumbnail' => $tag->thumbnail ];

            $tag->update([
                'name' => $values['name'],
                'slug' => $values['slug'],
                'description' => $values['description'],
                'thumbnail' => prep($values['thumbnail'])->uplab()
            ]);

            DB::commit();

            uplab($values['thumbnail'])->persist($tag->thumbnail->location, $previous->thumbnail->location);

            return true;
        } catch (Exception $e) {
            DB::rollback();

            if (env('APP_DEBUG')) throw $e;

            return false;
        }
    }

    /**
     * Faz a exclusão de uma tag.
     *
     * @param $tag
     * @return Tag|bool
     * @throws Exception
     */
    public function destroy($tag)
    {
        DB::beginTransaction();

        try {
            $tag->delete();

            DB::commit();

            storage()->deleteDirectory($tag->thumbnail->dir);

            return $tag;
        } catch (Exception $e) {
            DB::rollback();

            if (env('APP_DEBUG')) throw $e;

            return false;
        }
    }
}
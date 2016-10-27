<?php

namespace App\Repositories\Tag;

use App\Models\Tag;
use Exception;
use Illuminate\Support\Facades\DB;

class EloquentTagRepository implements TagRepository
{
    /**
     * Retorna todas as tags existentes.
     *
     * @param array $columns
     * @return mixed
     */
    public function getAll($columns = [ '*' ])
    {
        $tags = Tag::latest('created_at');

        return $tags->get($columns);
    }

    /**
     * Retorna todas as tags fazendo uso da paginação.
     *
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function getPaging($perPage = 15, $columns = [ '*' ])
    {
        $tags = Tag::latest('created_at');

        return $tags->paginate($perPage, $columns);
    }

    /**
     * Retorna as tags encontradas para uma dada busca.
     *
     * @param $q
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function findByQuery($q, $perPage = 15, $columns = [ '*' ])
    {
        return Tag::where('name', 'ILIKE', '%'.$q.'%')
            ->orWhere('description', 'ILIKE', '%'.$q.'%')
            ->latest('created_at')
            ->paginate($perPage, $columns)
            ->appends([ 'q' => $q ]);
    }

    /**
     * Retorna uma dada tag através do campo ID.
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
     * Retorna uma dada tag através do campo slug.
     *
     * @param $slug
     * @param array $columns
     * @return mixed
     */
    public function findBySlug($slug, $columns = [ '*' ])
    {
        return Tag::where('slug', $slug)->first($columns);
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
                'slug' => sys_val($values['name'])->slug(),
                'description' => $values['description'],
                'thumbnail' => sys_val($values['thumbnail'])->uplab(),
                'published_at' => sys_val($values['published_at'])->date(),
                'is_visible' => sys_val($values['is_visible'])->boolean()
            ]);

            DB::commit();

            uplab($values['thumbnail'])->persist($tag->thumbnail);

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
                'slug' => sys_val($values['name'])->slug(),
                'description' => $values['description'],
                'thumbnail' => sys_val($values['thumbnail'])->uplab(),
                'published_at' => sys_val($values['published_at'])->date(),
                'is_visible' => sys_val($values['is_visible'])->boolean()
            ]);

            DB::commit();

            uplab($values['thumbnail'])->persist($tag->thumbnail, $previous->thumbnail);

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
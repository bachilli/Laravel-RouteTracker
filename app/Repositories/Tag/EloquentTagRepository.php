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
     * @return Tag
     */
    public function getOnly($columns = [ '*' ])
    {
        return $tags->get($columns);
    }

    /**
     * Retorna todas as tags fazendo uso da paginação.
     *
     * @param array $columns
     * @return Tag
     */
    public function getAndPage($columns = [ '*' ])
    {
        return $tags->paginate($this->limit, $columns);
    }

    /**
     * Retorna as tags encontradas para uma dada busca.
     *
     * @param $q
     * @param array $columns
     * @return Tag
     */
    public function searchOnly($q, $columns = [ '*' ])
    {
        return Tag::where('name', 'ILIKE', '%'.$q.'%')
            ->orWhere('description', 'ILIKE', '%'.$q.'%')
            ->paginate($columns)
            ->appends([ 'q' => $q ]);
    }

    /**
     * Retorna uma dada tag através do campo ID.
     *
     * @param $id
     * @param array $columns
     * @return Tag
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
     * @return Tag
     */
    public function findBySlug($slug, $columns = [ '*' ])
    {
        return Tag::where('slug', $slug)->first($columns);
    }

    /**
     * Cria uma nova tag.
     *
     * @param $values
     * @return Tag|null
     * @throws Exception
     */
    public function store($values)
    {
        DB::beginTransaction();

        try {
            $tag = Tag::create($values);

            DB::commit();

            uplab($values['thumbnail'])->persist($tag->thumbnail);

            return $tag;
        } catch (Exception $e) {
            DB::rollback();

            return show_debug($e);
        }
    }

    /**
     * Realiza a atualização de uma tag.
     *
     * @param $values
     * @param $tag
     * @return Tag|null
     * @throws Exception
     */
    public function update($values, $tag)
    {
        DB::beginTransaction();

        try {
            $bkp = (object) [ 'thumbnail' => $tag->thumbnail ];

            $tag->update($values);

            DB::commit();

            uplab($values['thumbnail'])->persist($tag->thumbnail, $bkp->thumbnail);

            return $tag;
        } catch (Exception $e) {
            DB::rollback();

            return show_debug($e);
        }
    }

    /**
     * Faz a exclusão de uma tag.
     *
     * @param $tag
     * @return Tag|null
     * @throws Exception
     */
    public function destroy($tag)
    {
        DB::beginTransaction();

        try {
            $tag->delete();

            DB::commit();

            uplab($tag->thumbnail)->delete();

            return $tag;
        } catch (Exception $e) {
            DB::rollback();

            return show_debug($e);
        }
    }

    /**
     * Torna visível ou invisível uma tag.
     *
     * @param $tag
     * @return Tag|null
     * @throws Exception
     */
    public function visibility($tag)
    {
        DB::beginTransaction();

        try {
            $tag->update([ 'is_visible' => ! $tag->is_visible ]);

            DB::commit();

            return $tag;
        } catch (Exception $e) {
            DB::rollback();

            return show_debug($e);
        }
    }
}
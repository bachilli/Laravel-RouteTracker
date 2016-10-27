<?php

namespace App\Repositories\Tag;

interface TagRepository
{
    /**
     * Retorna todas as tags existentes.
     *
     * @param array $columns
     * @return mixed
     */
    public function getAll($columns = [ '*' ]);

    /**
     * Retorna todas as tags fazendo uso da paginação.
     *
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function getPaging($perPage = 15, $columns = [ '*' ]);

    /**
     * Retorna as tags encontradas para uma dada busca.
     *
     * @param $q
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function findByQuery($q, $perPage = 15, $columns = [ '*' ]);

    /**
     * Retorna uma dada tag através do campo ID.
     *
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function findById($id, $columns = [ '*' ]);

    /**
     * Retorna uma dada tag através do campo slug.
     *
     * @param $slug
     * @param array $columns
     * @return mixed
     */
    public function findBySlug($slug, $columns = [ '*' ]);

    /**
     * Cria uma nova tag.
     *
     * @param $data
     * @return mixed
     */
    public function store($data);

    /**
     * Realiza a atualização de uma tag.
     *
     * @param $data
     * @param $tag
     * @return bool
     */
    public function update($data, $tag);

    /**
     * Faz a exclusão de uma tag.
     *
     * @param $tag
     * @return bool
     */
    public function destroy($tag);
}
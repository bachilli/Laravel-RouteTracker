<?php

namespace App\Repositories\Content;

use App\Models\Content;
use Exception;

interface ContentRepository
{
    /**
     * Retorna todos os conteúdos das fontes existentes.
     *
     * @param array $columns
     * @return mixed
     */
    public function getAll($columns = [ '*' ]);

    /**
     * Retorna todos os conteúdos das fontes fazendo uso da paginação.
     *
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function getPaging($perPage = 15, $columns = [ '*' ]);

    /**
     * Retorna os conteúdos das fontes encontrados para uma dada busca.
     *
     * @param $q
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function findByQuery($q, $perPage = 15, $columns = [ '*' ]);

    /**
     * Retorna o conteúdo de uma dada fonte através do campo ID.
     *
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function findById($id, $columns = [ '*' ]);

    /**
     * Cria um novo conteúdo de uma dada fonte.
     *
     * @param $values
     * @return .|bool
     * @throws Exception
     */
    public function store($values);

    /**
     * Realiza a atualização do conteúdo de uma dada fonte.
     *
     * @param $values
     * @param $content
     * @return Content|bool
     * @throws Exception
     */
    public function update($values, $content);

    /**
     * Faz a exclusão do conteúdo de uma dada fonte.
     *
     * @param $content
     * @return Content|bool
     * @throws Exception
     */
    public function destroy($content);
}
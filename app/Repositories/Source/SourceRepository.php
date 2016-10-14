<?php

namespace App\Repositories\Source;

use App\Models\Source;
use Exception;

interface SourceRepository
{
    /**
     * Retorna todas as fontes de conteúdo existentes.
     *
     * @param array $columns
     * @return mixed
     */
    public function getAll($columns = [ '*' ]);

    /**
     * Retorna todas as fontes de conteúdo fazendo uso da paginação.
     *
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function getPaging($perPage = 15, $columns = [ '*' ]);

    /**
     * Retorna as fontes de conteúdo encontradas para uma dada busca.
     *
     * @param $q
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function findByQuery($q, $perPage = 15, $columns = [ '*' ]);

    /**
     * Retorna uma dada fonte de conteúdo através do campo ID.
     *
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function findById($id, $columns = [ '*' ]);

    /**
     * Cria uma nova fonte de conteúdo.
     *
     * @param $values
     * @return Source|bool
     * @throws Exception
     */
    public function store($values);

    /**
     * Realiza a atualização de uma fonte de conteúdo.
     *
     * @param $values
     * @param $source
     * @return Source|bool
     * @throws Exception
     */
    public function update($values, $source);

    /**
     * Faz a exclusão de uma fonte de conteúdo.
     *
     * @param $source
     * @return Source|bool
     * @throws Exception
     */
    public function destroy($source);
}
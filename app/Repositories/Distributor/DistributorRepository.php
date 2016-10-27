<?php

namespace App\Repositories\Distributor;

use App\Models\Distributor;
use Exception;

interface DistributorRepository
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
     * @return Distributor|bool
     * @throws Exception
     */
    public function store($values);

    /**
     * Realiza a atualização de uma fonte de conteúdo.
     *
     * @param $values
     * @param $distributor
     * @return Distributor|bool
     * @throws Exception
     */
    public function update($values, $distributor);

    /**
     * Faz a exclusão de uma fonte de conteúdo.
     *
     * @param $distributor
     * @return Distributor|bool
     * @throws Exception
     */
    public function destroy($distributor);
}
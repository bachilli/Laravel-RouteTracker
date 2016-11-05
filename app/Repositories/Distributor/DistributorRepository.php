<?php

namespace App\Repositories\Distributor;

use App\Models\Distributor;
use Exception;

interface DistributorRepository
{
    /**
     * Retorna todas as distribuidoras existentes.
     *
     * @param array $columns
     * @return Distributor
     */
    public function getOnly($columns = [ '*' ]);

    /**
     * Retorna todas as distribuidoras fazendo uso da paginação.
     *
     * @param array $columns
     * @return Distributor
     */
    public function getAndPage($columns = [ '*' ]);

    /**
     * Retorna as distribuidoras para uma dada busca.
     *
     * @param $q
     * @param array $columns
     * @return Distributor
     */
    public function searchOnly($q, $columns = [ '*' ]);

    /**
     * Retorna uma distribuidora através do campo ID.
     *
     * @param $id
     * @param array $columns
     * @return Distributor
     */
    public function findById($id, $columns = [ '*' ]);

    /**
     * Cria uma nova distribuidora.
     *
     * @param $values
     * @return Distributor|null
     * @throws Exception
     */
    public function store($values);

    /**
     * Realiza a atualização de uma distribuidora.
     *
     * @param $values
     * @param $distributor
     * @return Distributor|null
     * @throws Exception
     */
    public function update($values, $distributor);

    /**
     * Faz a exclusão de uma distribuidora.
     *
     * @param $distributor
     * @return Distributor|null
     * @throws Exception
     */
    public function destroy($distributor);
}
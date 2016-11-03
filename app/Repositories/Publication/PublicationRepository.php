<?php

namespace App\Repositories\Publication;

use App\Models\Publication;
use Exception;

interface PublicationRepository
{
    /**
     * Retorna todos os conteúdos das fontes existentes.
     *
     * @param array $columns
     * @return Publication
     */
    public function getAll($columns = [ '*' ]);

    /**
     * Retorna todos os conteúdos das fontes fazendo uso da paginação.
     *
     * @param int $perPage
     * @param array $columns
     * @return Publication
     */
    public function getPaging($perPage = 15, $columns = [ '*' ]);

    /**
     * Retorna os conteúdos das fontes encontrados para uma dada busca.
     *
     * @param $q
     * @param int $perPage
     * @param array $columns
     * @return Publication
     */
    public function findByQuery($q, $perPage = 15, $columns = [ '*' ]);

    /**
     * Retorna o conteúdo de uma dada fonte através do campo ID.
     *
     * @param $id
     * @param array $columns
     * @return Publication
     */
    public function findById($id, $columns = [ '*' ]);

    /**
     * Retorna uma dada publicação através do distribuidor.
     *
     * @param $distributorId
     * @param $type
     * @param array $columns
     * @return Publication
     */
    public function findByDistributorId($distributorId, $type, $columns = [ '*' ]);

    /**
     * Verifica se uma dada publicação já existe.
     *
     * @param $key
     * @param $distributorId
     * @param $type
     * @return Publication
     */
    public function exists($key, $distributorId, $type);

    /**
     * Cria uma nova publicação.
     *
     * @param $values
     * @return Publication|null
     * @throws Exception
     */
    public function store($values);
}
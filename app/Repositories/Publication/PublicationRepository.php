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
}
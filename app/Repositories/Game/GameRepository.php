<?php

namespace App\Repositories\Game;

use App\Models\Game;
use Exception;

interface GameRepository
{
    /**
     * Retorna todos os jogos existentes.
     *
     * @param array $columns
     * @return mixed
     */
    public function getAll($columns = [ '*' ]);

    /**
     * Retorna todos os jogos fazendo uso da paginação.
     *
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function getPaging($perPage = 15, $columns = [ '*' ]);

    /**
     * Retorna os jogos encontrados para uma dada busca.
     *
     * @param $q
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function findByQuery($q, $perPage = 15, $columns = [ '*' ]);

    /**
     * Retorna um dado jogo através do campo ID.
     *
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function findById($id, $columns = [ '*' ]);

    /**
     * Cria um novo jogo.
     *
     * @param $values
     * @return Game|bool
     * @throws Exception
     */
    public function store($values);

    /**
     * Realiza a atualização de um jogo.
     *
     * @param $values
     * @param $game
     * @return Game|bool
     * @throws Exception
     */
    public function update($values, $game);

    /**
     * Faz a exclusão de um jogo.
     *
     * @param $game
     * @return Game|bool
     * @throws Exception
     */
    public function destroy($game);
}
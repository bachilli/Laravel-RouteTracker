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
     * @return Game
     */
    public function getAll($columns = [ '*' ]);

    /**
     * Retorna todos os jogos fazendo uso da paginação.
     *
     * @param int $perPage
     * @param array $columns
     * @return Game
     */
    public function getPaging($perPage = 15, $columns = [ '*' ]);

    /**
     * Retorna os jogos encontrados para uma dada busca.
     *
     * @param $q
     * @param int $perPage
     * @param array $columns
     * @return Game
     */
    public function findByQuery($q, $perPage = 15, $columns = [ '*' ]);

    /**
     * Retorna um dado jogo através do campo ID.
     *
     * @param $id
     * @param array $columns
     * @return Game
     */
    public function findById($id, $columns = [ '*' ]);

    /**
     * Retorna um dado jogo através do campo slug.
     *
     * @param $slug
     * @param array $columns
     * @return Game
     */
    public function findBySlug($slug, $columns = [ '*' ]);

    /**
     * Cria um novo jogo.
     *
     * @param $values
     * @return Game|null
     * @throws Exception
     */
    public function store($values);

    /**
     * Realiza a atualização de um jogo.
     *
     * @param $values
     * @param $game
     * @return Game|null
     * @throws Exception
     */
    public function update($values, $game);

    /**
     * Faz a exclusão de um jogo.
     *
     * @param $game
     * @return Game|null
     * @throws Exception
     */
    public function destroy($game);

    /**
     * Torna visível ou invisível um artigo.
     *
     * @param $game
     * @return Game|null
     * @throws Exception
     */
    public function visibility($game);
}
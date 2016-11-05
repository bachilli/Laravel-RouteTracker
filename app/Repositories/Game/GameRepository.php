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
    public function getOnly($columns = [ '*' ]);

    /**
     * Retorna todos os jogos fazendo uso da paginação.
     *
     * @param array $columns
     * @return Game
     */
    public function getAndPage($columns = [ '*' ]);

    /**
     * Retorna os jogos encontrados para uma dada busca.
     *
     * @param $q
     * @param array $columns
     * @return Game
     */
    public function searchOnly($q, $columns = [ '*' ]);

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
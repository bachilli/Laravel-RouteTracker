<?php

namespace App\Repositories\Game;

use App\Models\Game;
use Exception;
use Illuminate\Support\Facades\DB;

class EloquentGameRepository implements GameRepository
{
    /**
     * Retorna todos os jogos existentes.
     *
     * @param array $columns
     * @return Game
     */
    public function getAll($columns = [ '*' ])
    {
        $games = Game::latest('id')->latest('published_at');

        return $games->get($columns);
    }

    /**
     * Retorna todos os jogos fazendo uso da paginação.
     *
     * @param int $perPage
     * @param array $columns
     * @return Game
     */
    public function getPaging($perPage = 15, $columns = [ '*' ])
    {
        $games = Game::latest('id')->latest('published_at');

        return $games->paginate($perPage, $columns);
    }

    /**
     * Retorna os jogos encontrados para uma dada busca.
     *
     * @param $q
     * @param int $perPage
     * @param array $columns
     * @return Game
     */
    public function findByQuery($q, $perPage = 15, $columns = [ '*' ])
    {
        return Game::where('name', 'ILIKE', '%'.$q.'%')
            ->orWhere('description', 'ILIKE', '%'.$q.'%')
            ->latest('id')
            ->latest('published_at')
            ->paginate($perPage, $columns)
            ->appends([ 'q' => $q ]);
    }

    /**
     * Retorna um dado jogo através do campo ID.
     *
     * @param $id
     * @param array $columns
     * @return Game
     */
    public function findById($id, $columns = [ '*' ])
    {
        return Game::find($id, $columns);
    }

    /**
     * Retorna um dado jogo através do campo slug.
     *
     * @param $slug
     * @param array $columns
     * @return Game
     */
    public function findBySlug($slug, $columns = [ '*' ])
    {
        return Game::where('slug', $slug)->first($columns);
    }

    /**
     * Cria um novo jogo.
     *
     * @param $values
     * @return Game|null
     * @throws Exception
     */
    public function store($values)
    {
        DB::beginTransaction();

        try {
            $game = Game::create($values);

            $game->tags()->sync(
                array_key_exists('tag_list', $values) ? $values['tag_list'] : []
            );

            DB::commit();

            uplab($values['thumbnail'])->persist($game->thumbnail);

            return $game;
        } catch (Exception $e) {
            DB::rollback();

            return show_debug($e);
        }
    }

    /**
     * Realiza a atualização de um jogo.
     *
     * @param $values
     * @param $game
     * @return Game|null
     * @throws Exception
     */
    public function update($values, $game)
    {
        DB::beginTransaction();

        try {
            $bkp = (object) [ 'thumbnail' => $game->thumbnail ];

            $game->update($values);

            $game->tags()->sync(
                array_key_exists('tag_list', $values) ? $values['tag_list'] : []
            );

            DB::commit();

            uplab($values['thumbnail'])->persist($game->thumbnail, $bkp->thumbnail);

            return $game;
        } catch (Exception $e) {
            DB::rollback();

            return show_debug($e);
        }
    }

    /**
     * Faz a exclusão de um jogo.
     *
     * @param $game
     * @return Game|null
     * @throws Exception
     */
    public function destroy($game)
    {
        DB::beginTransaction();

        try {
            $game->delete();

            DB::commit();

            uplab($game->thumbnail)->delete();

            return $game;
        } catch (Exception $e) {
            DB::rollback();

            return show_debug($e);
        }
    }

    /**
     * Torna visível ou invisível um artigo.
     *
     * @param $game
     * @return Tag|
     * @throws Exception
     */
    public function visibility($game)
    {
        DB::beginTransaction();

        try {
            $game->update([ 'is_visible' => ! $game->is_visible ]);

            DB::commit();

            return $game;
        } catch (Exception $e) {
            DB::rollback();

            return show_debug($e);
        }
    }
}
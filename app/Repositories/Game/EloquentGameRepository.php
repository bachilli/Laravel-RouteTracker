<?php

namespace App\Repositories\Game;

use App\Models\Game;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

class EloquentGameRepository implements GameRepository
{
    /**
     * EloquentGameRepository constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->table = DB::table('games');
        $this->restriction = [];
        $this->sort = [];
        $this->limit = 20;
        $this->offset = 0;

        $this->setSort('id:DESC|published_at:DESC');
    }

    /**
     * Retorna todos os jogos existentes.
     *
     * @param array $columns
     * @return Game
     */
    public function getOnly($columns = [ '*' ])
    {
        $this->queryLimit();

        $this->queryRestriction();

        $this->querySort();

        return $this->table->get($columns);
    }

    /**
     * Retorna todos os jogos fazendo uso da paginação.
     *
     * @param array $columns
     * @return Game
     */
    public function getAndPage($columns = [ '*' ])
    {
        $this->queryRestriction();

        $this->querySort();

        return $this->table->paginate($this->limit, $columns);
    }

    /**
     * Retorna os jogos encontrados para uma dada busca.
     *
     * @param $q
     * @param array $columns
     * @return Game
     */
    public function searchOnly($q, $columns = [ '*' ])
    {
        $this->queryRestriction();

        $this->querySort();

        return $this->table->where('name', 'ILIKE', '%'.$q.'%')
            ->orWhere('description', 'ILIKE', '%'.$q.'%')
            ->paginate($this->limit, $columns)
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
        $this->queryRestriction();

        $this->querySort();

        return $this->table->find($id, $columns);
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
        $this->queryRestriction();

        $this->querySort();

        return $this->table->where('slug', $slug)->first($columns);
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
     * @return Game|null
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

    /**
     * Limita a consulta de acordo com as restrições definidas.
     *
     * @return void
     */
    private function queryRestriction()
    {
        foreach ($this->restriction as $restriction) {
            if ($restriction == 'visible') {
                $this->table->where('is_visible', true);
            }

            if ($restriction == 'published') {
                $this->table->where('published_at', '<=', Carbon::now());
            }
        }
    }
}
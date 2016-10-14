<?php

namespace App\Repositories\Game;

use App\Models\Game;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

class EloquentGameRepository implements GameRepository
{
    /**
     * Retorna todos os jogos existentes.
     *
     * @param array $columns
     * @return mixed
     */
    public function getAll($columns = [ '*' ])
    {
        return Game::latest('created_at')->get($columns);
    }

    /**
     * Retorna todos os jogos fazendo uso da paginação.
     *
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function getPaging($perPage = 15, $columns = [ '*' ])
    {
        return Game::latest('id')->paginate($perPage, $columns);
    }

    /**
     * Retorna os jogos encontrados para uma dada busca.
     *
     * @param $q
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function findByQuery($q, $perPage = 15, $columns = [ '*' ])
    {
        return Game::where('name', 'ILIKE', '%'.$q.'%')
            ->orWhere('description', 'ILIKE', '%'.$q.'%')
            ->latest('created_at')
            ->paginate($perPage, $columns)
            ->appends([ 'q' => $q ]);
    }

    /**
     * Retorna um dado jogo através do campo ID.
     *
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function findById($id, $columns = [ '*' ])
    {
        return Game::find($id, $columns);
    }

    /**
     * Cria um novo jogo.
     *
     * @param $values
     * @return Game|bool
     * @throws Exception
     */
    public function store($values)
    {
        DB::beginTransaction();

        try {
            $sysVal = sys_val($values);

            $game = Game::create([
                'published_at' => Carbon::now(),
                'name' => $values['name'],
                'slug' => $sysVal->slug('name'),
                'excerpt' => $values['excerpt'],
                'description' => $values['description'],
                'instructions' => $sysVal->keyTips('instructions'),
                'dimensions' => $sysVal->dimensions([ 'width', 'height', 'aspect_ratio' ]),
                'classification' => $values['classification'],
                'type' => $values['type'],
                'embed' => $sysVal->embed([ 'embed_src', 'embed_type' ]),
                'is_published' => $sysVal->bool('is_published'),
                'file' => $sysVal->uplab('file'),
                'thumbnail' => $sysVal->uplab('thumbnail')
            ]);

            DB::commit();

            uplab($values['file'])->persist($game->file);
            uplab($values['thumbnail'])->persist($game->thumbnail);

            return $game;
        } catch (Exception $e) {
            DB::rollback();

            if (env('APP_DEBUG')) throw $e;

            return false;
        }
    }

    /**
     * Realiza a atualização de um jogo.
     *
     * @param $values
     * @param $game
     * @return Game|bool
     * @throws Exception
     */
    public function update($values, $game)
    {
        DB::beginTransaction();

        try {
            $sysVal = sys_val($values);

            $previous = (object) [ 'thumbnail' => $game->thumbnail ];

            $game->update([
                'name' => $values['name'],
                'slug' => $sysVal->slug('name'),
                'description' => $values['description'],
                'thumbnail' => $sysVal->uplab('thumbnail')
            ]);

            DB::commit();

            uplab($values['thumbnail'])->persist($game->thumbnail, $previous->thumbnail);

            return true;
        } catch (Exception $e) {
            DB::rollback();

            if (env('APP_DEBUG')) throw $e;

            return false;
        }
    }

    /**
     * Faz a exclusão de um jogo.
     *
     * @param $game
     * @return Game|bool
     * @throws Exception
     */
    public function destroy($game)
    {
        DB::beginTransaction();

        try {
            $game->delete();

            DB::commit();

            storage()->deleteDirectory($game->thumbnail->dir);

            return $game;
        } catch (Exception $e) {
            DB::rollback();

            if (env('APP_DEBUG')) throw $e;

            return false;
        }
    }
}
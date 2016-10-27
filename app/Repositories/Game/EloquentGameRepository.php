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
     * @return mixed
     */
    public function getAll($columns = [ '*' ])
    {
        $games = Game::latest('created_at');

        return $games->get($columns);
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
        $games = Game::latest('created_at');

        return $games->paginate($perPage, $columns);
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
     * Retorna um dado jogo através do campo slug.
     *
     * @param $slug
     * @param array $columns
     * @return mixed
     */
    public function findBySlug($slug, $columns = [ '*' ])
    {
        return Game::where('slug', $slug)->first($columns);
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
            $game = Game::create([
                'name' => $values['name'],
                'slug' => sys_val($values['name'])->slug(),
                'excerpt' => $values['excerpt'],
                'description' => $values['description'],
                'instructions' => sys_val($values['instructions'])->keytips(),
                'dimensions' => sys_val([
                    $values['width'],
                    $values['height'],
                    $values['aspect_ratio']
                ])->dimensions(),
                'age_range' => $values['age_range'],
                'embed' => sys_val([
                    $values['embed_src'],
                    $values['embed_type']
                ])->embed(),
                'file' => sys_val($values['file'])->uplab(),
                'thumbnail' => sys_val($values['thumbnail'])->uplab(),
                'published_at' => sys_val($values['published_at'])->date(),
                'is_visible' => sys_val($values['is_visible'])->boolean()
            ]);

            $tagList = [];

            if (array_key_exists('tag_list', $values)) $tagList = $values['tag_list'];

            $game->tags()->sync($tagList);

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
            $previous = (object) [ 'thumbnail' => $game->thumbnail ];

            $game->update([
                'name' => $values['name'],
                'slug' => sys_val($values['name'])->slug(),
                'description' => $values['description'],
                'thumbnail' => sys_val($values['thumbnail'])->uplab()
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

            uplab($game->thumbnail)->delete();

            return $game;
        } catch (Exception $e) {
            DB::rollback();

            if (env('APP_DEBUG')) throw $e;

            return false;
        }
    }

    /**
     * Publica ou despublica um artigo.
     *
     * @param $game
     * @return bool
     * @throws Exception
     */
    public function publish($game)
    {
        DB::beginTransaction();

        try {
            $game->update([ 'is_visible' => ! $game->is_visible ]);

            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollback();

            if (env('APP_DEBUG')) throw $e;

            return false;
        }
    }
}
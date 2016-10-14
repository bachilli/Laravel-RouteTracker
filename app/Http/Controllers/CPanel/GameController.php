<?php

namespace App\Http\Controllers\CPanel;

use App\Http\Controllers\Controller;
use App\Http\Requests\CPanel\Game\GameStoreRequest;
use App\Http\Requests\CPanel\Game\GameUpdateRequest;
use App\Models\Game;
use App\Repositories\Game\GameRepository;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class GameController extends Controller
{
    /**
     * Repositório de CRUD dos jogos.
     *
     * @var GameRepository
     */
    private $gameRepository;

    /**
     * Construtor dos jogos.
     *
     * @param GameRepository $gameRepository
     */
    public function __construct(GameRepository $gameRepository)
    {
        parent::__construct();

        $this->gameRepository = $gameRepository;
    }

    /**
     * Retorna todos os jogos cadastrados.
     *
     * @return View
     */
    public function index()
    {
        $games = $this->gameRepository->getPaging();

        return view('cpanel.games.index', compact('games'));
    }

    /**
     * Visão geral dos jogos.
     *
     * @return View
     */
    public function overview()
    {
        return view('cpanel.games.overview');
    }

    /**
     * Retorna um dado jogo cadastrado.
     *
     * @param Game $game
     * @return View
     */
    public function show(Game $game)
    {
        return view('cpanel.games.show', compact('game'));
    }

    /**
     * Formulário para criação de um novo jogo.
     *
     * @return View
     */
    public function create()
    {
        return view('cpanel.games.create');
    }

    /**
     * Adiciona um novo jogo.
     *
     * @param GameStoreRequest $request
     * @return Redirect
     */
    public function store(GameStoreRequest $request)
    {
        $game = $this->gameRepository->store($request->all());

        if (! empty($game)) {
            multialerts()->success('games.successfully_stored', [ 'name' => $game->name ])->put();

            return to('CPanel\GameController@index');
        }

        multialerts()->danger('games.store_fail')->put();

        return retry();
    }

    /**
     * Formulário para edição de um dado jogo.
     *
     * @param Game $game
     * @return View
     */
    public function edit(Game $game)
    {
        return view('cpanel.games.edit', compact('game'));
    }

    /**
     * Realiza a atualização de um dado jogo.
     *
     * @param GameUpdateRequest $request
     * @param Game $game
     * @return Redirect
     */
    public function update(GameUpdateRequest $request, Game $game)
    {
        if ($this->gameRepository->update($request->all(), $game)) {
            multialerts()->success('games.successfully_updated', [ 'name' => $game->name ])->put();

            return to('CPanel\GameController@index');
        }

        multialerts()->danger('games.update_fail')->put();

        return retry();
    }

    /**
     * Faz a exclusão de um dado jogo.
     *
     * @param Game $game
     * @return Redirect
     */
    public function destroy(Game $game)
    {
        if (! empty($game) && $this->gameRepository->destroy($game)) {
            multialerts()->success('games.successfully_deleted', [ 'name' => $game->name ])->put();
        } else {
            multialerts()->danger('games.delete_fail')->put();
        }

        return to('CPanel\GameController@index');
    }
}
<?php

namespace App\Http\Controllers\Primary;

use App\Http\Controllers\Controller;
use App\Repositories\Game\GameRepository;
use Illuminate\Contracts\View\View;

class GameController extends Controller
{
    /**
     * Repositório da entidade jogos.
     *
     * @var GameRepository
     */
    private $gameRepository;

    /**
     * Construtor dos jogos.
     *
     * @param GameRepository $gameRepository
     * @return void
     */
    public function __construct(GameRepository $gameRepository)
    {
        parent::__construct();

        $this->gameRepository = $gameRepository;
    }

    /**
     * ...
     *
     * @return View
     */
    public function index()
    {
        return view('primary.games.index');
    }

    /**
     * ...
     *
     * @param $slug
     * @return View
     */
    public function single($slug)
    {
        $game = $this->gameRepository->findBySlug($slug);

        if (! empty($game) && $game->is_visible) {
            return view('primary.games.single', compact('game'));
        }

        return view('primary.404');
    }
}
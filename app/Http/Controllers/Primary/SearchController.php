<?php

namespace App\Http\Controllers\Primary;

use App\Http\Controllers\Controller;
use App\Repositories\Game\GameRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Repositório da entidade jogos.
     *
     * @var GameRepository
     */
    private $gameRepository;

    /**
     * Construtor do controlador de busca do site.
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
     * @param Request $request
     * @return View
     */
    public function index(Request $request)
    {
        $query = $request->input('q');

        $games = $this->gameRepository->findByQuery($query);

        return view('primary.search', compact('games'));
    }
}
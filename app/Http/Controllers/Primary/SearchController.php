<?php

namespace App\Http\Controllers\Primary;

use App\Http\Controllers\Controller;
use App\Repositories\Game\GameRepository;
use App\Repositories\Tag\TagRepository;
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
     * Repositório da entidade tags.
     *
     * @var TagRepository
     */
    private $tagRepository;

    /**
     * Construtor do controlador de busca do site.
     *
     * @param GameRepository $gameRepository
     * @param TagRepository $tagRepository
     */
    public function __construct(GameRepository $gameRepository,
                                TagRepository $tagRepository)
    {
        parent::__construct();

        $this->gameRepository = $gameRepository;
        $this->tagRepository = $tagRepository;
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
        $searchTags = $this->tagRepository->findByQuery($query);

        return view('primary.search', compact('games', 'searchTags'));
    }
}
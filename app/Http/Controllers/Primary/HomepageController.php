<?php

namespace App\Http\Controllers\Primary;

use App\Repositories\Game\GameRepository;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;

class HomepageController extends Controller
{
    /**
     * Repositório da entidade jogos.
     *
     * @var GameRepository
     */
    private $gameRepository;

    /**
     * Construtor da página inicial do site.
     *
     * @param GameRepository $gameRepository
     */
    public function __construct(GameRepository $gameRepository)
    {
        parent::__construct();

        $this->gameRepository = $gameRepository;
    }

    /**
     * Retorna a página inicial do site.
     *
     * @return View
     */
    public function index()
    {
        $games = $this->gameRepository->getPaging();

        meta_tags()->title('Título...');
        meta_tags()->description('Descrição...');

        return view('primary.homepage', compact('games'));
    }
}
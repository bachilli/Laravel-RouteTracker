<?php

namespace App\Http\Controllers\CPanel\Distributor;

use App\Repositories\Publication\PublicationRepository;
use GuzzleHttp\Client as GuzzleClient;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class SpilGamesController extends Controller
{
    const SPILGAMES_ID = 1;
    const SPILGAMES_API_KEY = '';
    const SPILGAMES_RSS_URL = 'http://publishers.spilgames.com/en/rss-3';

    /**
     * Repositório da entidade publicações.
     *
     * @var PublicationRepository
     */
    private $publicationRepository;

    /**
     * Construtor do controlador que captura os jogos da SpilGames.
     *
     * @param PublicationRepository $publicationRepository
     * @return void
     */
    public function __construct(PublicationRepository $publicationRepository)
    {
        parent::__construct();

        $this->publicationRepository = $publicationRepository;
    }

    /**
     * ...
     *
     * @return Redirect
     */
    public function index()
    {
        $games = [];
        $categories = [];
        $params = [
            'query' => [
                'limit' => 100,
                'format' => 'json',
                'platform' => 'Crossplatform',
                'page' => 1
            ],
            'timeout' => 10
        ];

        //
        // PASSO 1) Pega todos os jogos.
        //

        while (true) {
            $request = (new GuzzleClient)->get(self::SPILGAMES_RSS_URL, $params);

            $feed = json_decode(
                $request->getBody()->getContents()
            );

            foreach ($feed->entries as $entry) {
                $games[] = $entry;
            }

            if ($feed->totalPages === $params['query']['page']) {
                break;
            }

            $params['query']['page']++;
        }

        //
        // PASSO 2) Adiciona todos os jogos.
        //

        foreach ($games as $game) {
            $this->publicationRepository->store([
                'key' => md5($game->id),
                'distributor_id' => self::SPILGAMES_ID,
                'name' => $game->title,
                'type' => 'GAME',
                'status' => 'PENDING',
                'data' => [
                    'id' => $game->id,
                    'title' => $game->title,
                    'description' => $game->description,
                    'url' => $game->gameUrl,
                    'width' => $game->width,
                    'height' => $game->height,
                    'thumbnail' => $game->thumbnails->large,
                    'category' => $game->category,
                    'subcategory' => $game->subcategory
                ]
            ]);
        }

        //
        // PASSO 3) Pega todas as categorias.
        //

        foreach ($games as $game) {
            $categories[] = $game->category;
            $categories[] = $game->subcategory;
        }

        //
        // PASSO 4) Filtra categorias nulas e repetidas.
        //

        $categories = array_filter(
            array_unique($categories)
        );

        //
        // PASSO 5) Adiciona todas as categorias.
        //

        foreach ($categories as $category) {
            $this->publicationRepository->store([
                'key' => md5($category),
                'distributor_id' => self::SPILGAMES_ID,
                'name' => $category,
                'type' => 'TAG',
                'status' => 'PENDING',
                'data' => []
            ]);
        }

        return to('CPanel\PublicationController@index');
    }
}
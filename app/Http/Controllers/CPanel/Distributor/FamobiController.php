<?php

namespace App\Http\Controllers\CPanel\Distributor;

use App\Repositories\Publication\PublicationRepository;
use GuzzleHttp\Client as GuzzleClient;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class FamobiController extends Controller
{
    const FAMOBI_ID = 2;
    const FAMOBI_API_KEY = 'A-O3RFS';
    const FAMOBI_API_URL = 'http://api.famobi.com/feed';

    /**
     * Repositório da entidade publicações.
     *
     * @var PublicationRepository
     */
    private $publicationRepository;

    /**
     * Construtor do controlador que captura os jogos da Famobi.
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
        //
        // PASSO 1) Pega todos os jogos.
        //

        $request = (new GuzzleClient)->get(self::FAMOBI_API_URL, [
            'query' => [
                'a' => self::FAMOBI_API_KEY
            ],
            'timeout' => 10
        ]);

        $feed = json_decode(
            $request->getBody()->getContents()
        );

        //
        // PASSO 2) Adiciona todos os jogos.
        //

        foreach ($feed->games as $game) {
            $this->publicationRepository->store([
                'key' => md5($game->package_id),
                'distributor_id' => self::FAMOBI_ID,
                'name' => $game->name,
                'type' => 'GAME',
                'status' => 'PENDING',
                'data' => [
                    'package_id' => $game->package_id,
                    'name' => $game->name,
                    'description' => $game->description,
                    'thumb' => $game->thumb,
                    'thumb_60' => $game->thumb_60,
                    'thumb_120' => $game->thumb_120,
                    'thumb_180' => $game->thumb_180,
                    'link' => $game->link,
                    'date' => $game->date,
                    'aspect_ratio' => $game->aspect_ratio,
                    'orientation' => $game->orientation,
                    'categories' => $game->categories
                ]
            ]);
        }

        //
        // PASSO 3) Adiciona todas as categorias.
        //

        foreach ($feed->categories as $category) {
            $this->publicationRepository->store([
                'key' => md5($category),
                'distributor_id' => self::FAMOBI_ID,
                'name' => $category,
                'type' => 'TAG',
                'status' => 'PENDING',
                'data' => []
            ]);
        }

        return to('CPanel\PublicationController@index');
    }
}
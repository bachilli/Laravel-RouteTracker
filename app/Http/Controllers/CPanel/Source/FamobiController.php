<?php

namespace App\Http\Controllers\CPanel\Crawler\Famobi;

use App\Models\FamobiCategory;
use App\Models\FamobiGame;
use GuzzleHttp\Client as GuzzleClient;
use App\Http\Controllers\Controller;

class GameController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        // Envia as informações ao SVT
        $request = (new GuzzleClient)->get('http://api.famobi.com/feed', [
            'query' => [
                'a' => 'A-O3RFS'
            ],
            'timeout' => 10
        ]);

        $feed = json_decode(
            $request->getBody()->getContents()
        );

        // $feed->num_games

        foreach ($feed->games as $game) {
            FamobiGame::create([
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
                'categories' => json_encode($game->categories)
            ]);
        }

        foreach ($feed->categories as $category) {
            FamobiCategory::create([
                'name' =>  $category,
                'slug' => str_slug($category)
            ]);
        }

        return view('cpanel.crawlers.famobi.games.index', compact('feed'));
    }
}
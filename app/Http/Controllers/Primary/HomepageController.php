<?php

namespace App\Http\Controllers\Primary;

use PHPHtmlParser\Dom;
use App\Http\Controllers\Controller;

class HomepageController extends Controller
{
    /*private $categories;
    private $games;*/

    public function __construct()
    {
        parent::__construct();

        /*$this->games = [];
        $this->categories = [];*/
    }

    public function index()
    {
        /*ini_set('max_execution_time', 900);
        ini_set('max_input_time', 900);
        ini_set('memory_limit', '1024M');

        foreach ($this->categories as $tag) {
            $this->getGames('http://www.clickjogos.com.br'.$tag['url']);
        }*/

        return view('primary.homepage');
    }

    /*public function getGames($url)
    {
        $dom = new Dom;

        $dom->loadFromUrl($url);

        foreach ($dom->find('.game h3 a') as $game) {
            $game = [
                'name' => $game->text,
                'url' => $game->href
            ];

            $this->games[] = $game;

            $uniqueAlerts = array_unique(array_map('serialize', $this->games));

            $this->games = array_intersect_key($this->games, $uniqueAlerts);
        }

        $nextPage = $dom->find('.pagination a.next_page');

        if (sizeof($nextPage) > 0) {
            $this->getGames('http://www.clickjogos.com.br'.$nextPage->href);
        }
    }*/
}
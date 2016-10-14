<?php

namespace App\Http\Controllers\CPanel\Source;

use App\Models\Tag;
use PHPHtmlParser\Dom;
use App\Http\Controllers\Controller;

class CentralJogosController extends Controller
{
    private $categories;
    private $games;

    public function __construct()
    {
        parent::__construct();

        $this->games = [];
        $this->categories = [];
    }

    public function games()
    {
        // ...
    }

    public function categories()
    {
        $this->getCategories('http://www.clickjogos.com.br/categorias');

        foreach ($this->categories as $tag) {
            Tag::create([
                'name' => $tag['name'],
                'slug' => str_slug($tag['name'])
            ]);
        }
    }

    private function getGames($url)
    {
        // ...
    }

    private function getCategories($url)
    {
        $dom = new Dom;

        $dom->loadFromUrl($url);

        foreach ($dom->find('.category h3 a') as $tag) {
            $this->categories[] = [
                'name' => $tag->text,
                'url' => $tag->href
            ];
        }

        $nextPage = $dom->find('.pagination a.next_page');

        if (sizeof($nextPage) > 0) {
            $this->getCategories('http://www.clickjogos.com.br'.$nextPage->href);
        }
    }
}
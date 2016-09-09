<?php

namespace App\Http\Controllers\CPanel\Crawler\ClickJogos;

use App\Models\Category;
use PHPHtmlParser\Dom;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    private $categories;

    public function __construct()
    {
        parent::__construct();

        $this->categories = [];
    }

    public function index()
    {
        $this->getCategories('http://www.clickjogos.com.br/categorias');

        foreach ($this->categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => str_slug($category['name'])
            ]);
        }
    }

    private function getCategories($url)
    {
        $dom = new Dom;

        $dom->loadFromUrl($url);

        foreach ($dom->find('.category h3 a') as $category) {
            $this->categories[] = [
                'name' => $category->text,
                'url' => $category->href
            ];
        }

        $nextPage = $dom->find('.pagination a.next_page');

        if (sizeof($nextPage) > 0) {
            $this->getCategories('http://www.clickjogos.com.br'.$nextPage->href);
        }
    }
}
<?php

namespace App\Http\Controllers\Primary;

use App\Http\Controllers\Controller;
use App\Repositories\Tag\TagRepository;
use Illuminate\Contracts\View\View;

class TagController extends Controller
{
    /**
     * Repositório da entidade tags.
     *
     * @var TagRepository
     */
    private $tagRepository;

    /**
     * Construtor do controlador das tags.
     *
     * @param TagRepository $tagRepository
     * @return void
     */
    public function __construct(TagRepository $tagRepository)
    {
        parent::__construct();

        $this->tagRepository = $tagRepository;
    }

    /**
     * ...
     *
     * @return View
     */
    public function index()
    {
        return view('primary.tags.index');
    }

    /**
     * ...
     *
     * @param $slug
     * @return View
     */
    public function single($slug)
    {
        $tag = $this->tagRepository->findBySlug($slug);

        if (! empty($tag) && $tag->is_visible) {
            return view('primary.tags.single', compact('tag'));
        }

        return view('primary.404');
    }
}
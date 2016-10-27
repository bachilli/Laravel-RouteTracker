<?php

namespace App\Composers\Game;

use App\Repositories\Tag\TagRepository;

class TagComposer
{
    /**
     * Repositório da entidade tags.
     *
     * @var TagRepository
     */
    private $tagRepository;

    /**
     * Construtor da página inicial do site.
     *
     * @param TagRepository $tagRepository
     */
    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function compose($view)
    {
        $tags = $this->tagRepository->getAll();

        $view->with('tags', $tags);
    }
}
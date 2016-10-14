<?php

namespace App\Http\Controllers\CPanel;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Repositories\Content\ContentRepository;
use Illuminate\View\View;

class ContentController extends Controller
{
    /**
     * Repositório de CRUD das tags.
     *
     * @var ContentRepository
     */
    private $contentRepository;

    /**
     * Construtor das tags dos jogos.
     *
     * @param ContentRepository $contentRepository
     */
    public function __construct(ContentRepository $contentRepository)
    {
        parent::__construct();

        $this->contentRepository = $contentRepository;
    }

    public function index()
    {
        $contents = $this->contentRepository->getPaging();

        return view('cpanel.contents.index', compact('contents'));
    }

    /**
     * Visão geral das fontes de conteúdo.
     *
     * @return View
     */
    public function overview()
    {
        return view('cpanel.contents.overview');
    }

    /**
     * Retorna a tag cadastrada.
     *
     * @param Content $content
     * @return View
     */
    public function show(Content $content)
    {
        return view('cpanel.contents.show', compact('content'));
    }

    /**
     * ...
     *
     * @param Content $content
     */
    public function famobi(Content $content)
    {
        // ...
    }

    /**
     * @param Content $content
     */
    public function clickJogos(Content $content)
    {
        // ...
    }
}
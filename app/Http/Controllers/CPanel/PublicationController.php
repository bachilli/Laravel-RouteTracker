<?php

namespace App\Http\Controllers\CPanel;

use App\Http\Controllers\Controller;
use App\Models\Publication;
use App\Repositories\Publication\PublicationRepository;
use Illuminate\View\View;

class PublicationController extends Controller
{
    /**
     * Repositório da entidade conteúdos.
     *
     * @var PublicationRepository
     */
    private $publicationRepository;

    /**
     * Construtor da funcionalidade conteúdos.
     *
     * @param PublicationRepository $publicationRepository
     * @return void
     */
    public function __construct(PublicationRepository $publicationRepository)
    {
        parent::__construct();

        $this->publicationRepository = $publicationRepository;
    }

    public function index()
    {
        $publications = $this->publicationRepository->getPaging();

        return view('cpanel.publications.index', compact('publications'));
    }

    /**
     * Visão geral das fontes de conteúdo.
     *
     * @return View
     */
    public function overview()
    {
        return view('cpanel.publications.overview');
    }

    /**
     * Retorna a tag cadastrada.
     *
     * @param Publication $publication
     * @return View
     */
    public function show(Publication $publication)
    {
        return view('cpanel.publications.show', compact('publication'));
    }

    /**
     * ...
     *
     * @param Publication $publication
     */
    public function famobi(Publication $publication)
    {
        // ...
    }
}
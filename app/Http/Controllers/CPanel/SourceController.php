<?php

namespace App\Http\Controllers\CPanel;

use App\Http\Controllers\Controller;
use App\Http\Requests\CPanel\Game\SourceStoreRequest;
use App\Http\Requests\CPanel\Game\SourceUpdateRequest;
use App\Models\Source;
use App\Repositories\Source\SourceRepository;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class SourceController extends Controller
{
    /**
     * Repositório de CRUD das fontes de conteúdo.
     *
     * @var SourceRepository
     */
    private $sourceRepository;

    /**
     * Construtor das fontes de conteúdo.
     *
     * @param SourceRepository $sourceRepository
     */
    public function __construct(SourceRepository $sourceRepository)
    {
        parent::__construct();

        $this->sourceRepository = $sourceRepository;
    }

    /**
     * Retorna todas as fontes de conteúdo.
     *
     * @return View
     */
    public function index()
    {
        $sources = $this->sourceRepository->getPaging();

        return view('cpanel.sources.index', compact('sources'));
    }

    /**
     * Visão geral das fontes de conteúdo.
     *
     * @return View
     */
    public function overview()
    {
        return view('cpanel.sources.overview');
    }

    /**
     * Retorna uma fonte de conteúdo cadastrada.
     *
     * @param Source $source
     * @return View
     */
    public function show(Source $source)
    {
        return view('cpanel.sources.show', compact('source'));
    }

    /**
     * Formulário para criação de uma nova fonte de conteúdo.
     *
     * @return View
     */
    public function create()
    {
        return view('cpanel.sources.create');
    }

    /**
     * Adiciona uma nova fonte de conteúdo.
     *
     * @param SourceStoreRequest $request
     * @return Redirect
     */
    public function store(SourceStoreRequest $request)
    {
        $source = $this->sourceRepository->store($request->all());

        if (! empty($source)) {
            multialerts()->success('sources.successfully_stored', [ 'name' => $source->name ])->put();

            return to('CPanel\SourceController@index');
        }

        multialerts()->danger('sources.store_fail')->put();

        return retry();
    }

    /**
     * Formulário para edição de uma dada fonte de conteúdo.
     *
     * @param Source $source
     * @return View
     */
    public function edit(Source $source)
    {
        return view('cpanel.sources.edit', compact('source'));
    }

    /**
     * Realiza a atualização de uma dada fonte de conteúdo.
     *
     * @param SourceUpdateRequest $request
     * @param Source $source
     * @return Redirect
     */
    public function update(SourceUpdateRequest $request, Source $source)
    {
        if ($this->sourceRepository->update($request->all(), $source)) {
            multialerts()->success('sources.successfully_updated', [ 'name' => $source->name ])->put();

            return to('CPanel\SourceController@index');
        }

        multialerts()->danger('sources.update_fail')->put();

        return retry();
    }

    /**
     * Faz a exclusão de uma dada fonte de conteúdo.
     *
     * @param Source $source
     * @return Redirect
     */
    public function destroy(Source $source)
    {
        if (! empty($source) && $this->sourceRepository->destroy($source)) {
            multialerts()->success('sources.successfully_deleted', [ 'name' => $source->name ])->put();
        } else {
            multialerts()->danger('sources.delete_fail')->put();
        }

        return to('CPanel\SourceController@index');
    }

    /**
     * ...
     *
     * @param Source $source
     */
    public function famobi(Source $source)
    {
        // ...
    }

    /**
     * ...
     *
     * @param Source $source
     */
    public function clickJogos(Source $source)
    {
        // ...
    }
}
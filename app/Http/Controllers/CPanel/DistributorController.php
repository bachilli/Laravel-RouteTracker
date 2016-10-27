<?php

namespace App\Http\Controllers\CPanel;

use App\Http\Controllers\Controller;
use App\Http\Requests\CPanel\Distributor\DistributorStoreRequest;
use App\Http\Requests\CPanel\Distributor\DistributorUpdateRequest;
use App\Models\Distributor;
use App\Repositories\Distributor\DistributorRepository;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class DistributorController extends Controller
{
    /**
     * Repositório da entidade fontes de conteúdo.
     *
     * @var DistributorRepository
     */
    private $distributorRepository;

    /**
     * Construtor da funcionalidade fontes de conteúdo.
     *
     * @param DistributorRepository $distributorRepository
     * @return void
     */
    public function __construct(DistributorRepository $distributorRepository)
    {
        parent::__construct();

        $this->distributorRepository = $distributorRepository;
    }

    /**
     * Retorna todas as fontes de conteúdo.
     *
     * @return View
     */
    public function index()
    {
        $distributors = $this->distributorRepository->getPaging();

        return view('cpanel.distributors.index', compact('distributors'));
    }

    /**
     * Visão geral das fontes de conteúdo.
     *
     * @return View
     */
    public function overview()
    {
        return view('cpanel.distributors.overview');
    }

    /**
     * Retorna uma fonte de conteúdo cadastrada.
     *
     * @param Distributor $distributor
     * @return View
     */
    public function show(Distributor $distributor)
    {
        return view('cpanel.distributors.show', compact('distributor'));
    }

    /**
     * Formulário para criação de uma nova fonte de conteúdo.
     *
     * @return View
     */
    public function create()
    {
        return view('cpanel.distributors.create');
    }

    /**
     * Adiciona uma nova fonte de conteúdo.
     *
     * @param DistributorStoreRequest $request
     * @return Redirect
     */
    public function store(DistributorStoreRequest $request)
    {
        $distributor = $this->distributorRepository->store($request->all());

        if (! empty($distributor)) {
            multi_alerts()->success('distributors.successfully_stored', [ 'name' => $distributor->name ])->put();

            return to('CPanel\DistributorController@index');
        }

        multi_alerts()->danger('distributors.store_fail')->put();

        return retry();
    }

    /**
     * Formulário para edição de uma dada fonte de conteúdo.
     *
     * @param Distributor Distributor
     * @return View
     */
    public function edit(Distributor $distributor)
    {
        return view('cpanel.distributors.edit', compact('distributor'));
    }

    /**
     * Realiza a atualização de uma dada fonte de conteúdo.
     *
     * @param DistributorUpdateRequest $request
     * @param Distributor $distributor
     * @return Redirect
     */
    public function update(DistributorUpdateRequest $request, Distributor $distributor)
    {
        if ($this->distributorRepository->update($request->all(), $distributor)) {
            multi_alerts()->success('distributors.successfully_updated', [ 'name' => $distributor->name ])->put();

            return to('CPanel\DistributorController@index');
        }

        multi_alerts()->danger('distributors.update_fail')->put();

        return retry();
    }

    /**
     * Faz a exclusão de uma dada fonte de conteúdo.
     *
     * @param Distributor $distributor
     * @return Redirect
     */
    public function destroy(Distributor $distributor)
    {
        if (! empty($distributor) && $this->distributorRepository->destroy($distributor)) {
            multi_alerts()->success('distributors.successfully_deleted', [ 'name' => $distributor->name ])->put();
        } else {
            multi_alerts()->danger('distributors.delete_fail')->put();
        }

        return to('CPanel\DistributorController@index');
    }

    /**
     * ...
     *
     * @param Distributor $distributor
     */
    public function famobi(Distributor $distributor)
    {
        // ...
    }

    /**
     * ...
     *
     * @param Distributor $distributor
     */
    public function clickJogos(Distributor $distributor)
    {
        // ...
    }
}
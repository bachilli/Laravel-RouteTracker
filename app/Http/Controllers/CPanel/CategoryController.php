<?php

namespace App\Http\Controllers\CPanel;

use App\Http\Controllers\Controller;
use App\Http\Requests\CPanel\Category\CategoryStoreRequest;
use App\Http\Requests\CPanel\Category\CategoryUpdateRequest;
use App\Models\Category;
use App\Repositories\Category\CategoryCrudRepository;
use App\Repositories\Category\CategoryFetchRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Repositório de CRUD das categorias.
     *
     * @var CategoryCrudRepository
     */
    private $categoryCrudRepository;

    /**
     * Repositório de busca das categorias.
     *
     * @var CategoryFetchRepository
     */
    private $categoryFetchRepository;

    /**
     * Construtor das categorias dos jogos.
     *
     * @param CategoryCrudRepository $categoryCrudRepository
     * @param CategoryFetchRepository $categoryFetchRepository
     */
    public function __construct(CategoryCrudRepository $categoryCrudRepository,
                                CategoryFetchRepository $categoryFetchRepository)
    {
        parent::__construct();

        $this->categoryCrudRepository = $categoryCrudRepository;
        $this->categoryFetchRepository = $categoryFetchRepository;
    }

    /**
     * Retorna todas as categorias cadastradas.
     *
     * @return View
     */
    public function index()
    {
        $categories = $this->categoryFetchRepository->getPaging();

        return view('cpanel.categories.index', compact('categories'));
    }

    /**
     * Visão geral das categorias.
     * 
     * @return View
     */
    public function overview()
    {
        return view('cpanel.categories.overview');
    }

    /**
     * Retorna a categoria cadastrada.
     *
     * @param Category $category
     * @return View
     */
    public function show(Category $category)
    {
        return view('cpanel.categories.show', compact('category'));
    }

    /**
     * Formulário para criação de uma nova categoria.
     *
     * @return View
     */
    public function create()
    {
        return view('cpanel.categories.create');
    }

    /**
     * Adiciona uma nova categoria.
     *
     * @param CategoryStoreRequest $request
     * @return Redirect
     */
    public function store(CategoryStoreRequest $request)
    {
        $category = $this->categoryCrudRepository->store($request->all());

        if (! empty($category)) {
            multialerts()->success('categories.successfully_stored', [ 'name' => $category->name ])->put();

            return to('CPanel\CategoryController@index');
        }

        multialerts()->danger('categories.store_fail')->put();

        return retry();
    }

    /**
     * Formulário para edição da categoria.
     *
     * @param Category $category
     * @return View
     */
    public function edit(Category $category)
    {
        return view('cpanel.categories.edit', compact('category'));
    }

    /**
     * Realiza a atualização de uma categoria.
     *
     * @param CategoryUpdateRequest $request
     * @param Category $category
     * @return Redirect
     */
    public function update(CategoryUpdateRequest $request, Category $category)
    {
        if ($this->categoryCrudRepository->update($request->all(), $category)) {
            multialerts()->success('categories.successfully_updated', [ 'name' => $category->name ])->put();

            return to('CPanel\CategoryController@index');
        }

        multialerts()->danger('categories.update_fail')->put();

        return retry();
    }

    /**
     * Faz a exclusão de uma categoria.
     *
     * @param Category $category
     * @return Redirect
     */
    public function destroy(Category $category)
    {
        if (! empty($category) && $this->categoryCrudRepository->destroy($category)) {
            multialerts()->success('categories.successfully_deleted', [ 'name' => $category->name ])->put();
        } else {
            multialerts()->danger('categories.delete_fail')->put();
        }

        return to('CPanel\CategoryController@index');
    }
}
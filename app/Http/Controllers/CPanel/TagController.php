<?php

namespace App\Http\Controllers\CPanel;

use App\Http\Controllers\Controller;
use App\Http\Requests\CPanel\Tag\TagStoreRequest;
use App\Http\Requests\CPanel\Tag\TagUpdateRequest;
use App\Models\Tag;
use App\Repositories\Tag\TagRepository;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class TagController extends Controller
{
    /**
     * Repositório da entidade tags.
     *
     * @var TagRepository
     */
    private $tagRepository;

    /**
     * Construtor da funcionalidade tags.
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
     * Retorna todas as tags cadastradas.
     *
     * @return View
     */
    public function index()
    {
        $tags = $this->tagRepository->getAndPage();

        return view('cpanel.tags.index', compact('tags'));
    }

    /**
     * Visão geral das tags.
     * 
     * @return View
     */
    public function overview()
    {
        return view('cpanel.tags.overview');
    }

    /**
     * Retorna uma dada tag cadastrada.
     *
     * @param Tag $tag
     * @return View
     */
    public function show(Tag $tag)
    {
        return view('cpanel.tags.show', compact('tag'));
    }

    /**
     * Formulário para criação de uma nova tag.
     *
     * @return View
     */
    public function create()
    {
        return view('cpanel.tags.create');
    }

    /**
     * Adiciona uma nova tag.
     *
     * @param TagStoreRequest $request
     * @return Redirect
     */
    public function store(TagStoreRequest $request)
    {
        $tag = $this->tagRepository->store($request->all());

        if (! empty($tag)) {
            multi_alerts()->success('tags.successfully_stored', [ 'name' => $tag->name ])->put();

            return to('CPanel\TagController@index');
        }

        multi_alerts()->danger('tags.store_fail')->put();

        return retry();
    }

    /**
     * Formulário para edição de uma dada tag.
     *
     * @param Tag $tag
     * @return View
     */
    public function edit(Tag $tag)
    {
        return view('cpanel.tags.edit', compact('tag'));
    }

    /**
     * Realiza a atualização de uma dada tag.
     *
     * @param TagUpdateRequest $request
     * @param Tag $tag
     * @return Redirect
     */
    public function update(TagUpdateRequest $request, Tag $tag)
    {
        if ($this->tagRepository->update($request->all(), $tag)) {
            multi_alerts()->success('tags.successfully_updated', [ 'name' => $tag->name ])->put();

            return to('CPanel\TagController@edit', $tag->id);
        }

        multi_alerts()->danger('tags.update_fail')->put();

        return retry();
    }

    /**
     * Faz a exclusão de uma dada tag.
     *
     * @param Tag $tag
     * @return Redirect
     */
    public function destroy(Tag $tag)
    {
        if (! empty($tag) && $this->tagRepository->destroy($tag)) {
            multi_alerts()->success('tags.successfully_deleted', [ 'name' => $tag->name ])->put();
        } else {
            multi_alerts()->danger('tags.delete_fail')->put();
        }

        return to('CPanel\TagController@index');
    }

    /**
     * Torna uma tag visível ou invisível.
     *
     * @param $tag
     * @return Redirect
     */
    public function visibility(Tag $tag)
    {
        $this->tagRepository->visibility($tag);

        if ($tag->is_visible) {
            multi_alerts()->success('tags.successfully_visible', [ 'name' => $tag->name ])->put();
        } else {
            multi_alerts()->success('tags.successfully_invisible', [ 'name' => $tag->name ])->put();
        }

        return to('CPanel\TagController@index');
    }
}
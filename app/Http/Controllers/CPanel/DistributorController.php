<?php

namespace App\Http\Controllers\CPanel;

use App\Http\Controllers\Controller;
use App\Http\Requests\CPanel\Distributor\DistributorStoreRequest;
use App\Http\Requests\CPanel\Distributor\DistributorUpdateRequest;
use App\Models\Distributor;
use App\Repositories\Distributor\DistributorRepository;
use App\Repositories\Game\GameRepository;
use App\Repositories\Publication\PublicationRepository;
use App\Repositories\Tag\TagRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class DistributorController extends Controller
{
    const SPILGAMES_ID = 1;
    const FAMOBI_ID = 2;

    /**
     * Repositório da entidade fontes de conteúdo.
     *
     * @var DistributorRepository
     */
    private $distributorRepository;

    /**
     * Repositório da entidade conteúdos.
     *
     * @var PublicationRepository
     */
    private $publicationRepository;

    /**
     * Repositório da entidade jogos.
     *
     * @var GameRepository
     */
    private $gameRepository;

    /**
     * Repositório da entidade tags.
     *
     * @var TagRepository
     */
    private $tagRepository;

    /**
     * Construtor da funcionalidade fontes de conteúdo.
     *
     * @param DistributorRepository $distributorRepository
     * @param PublicationRepository $publicationRepository
     * @param GameRepository $gameRepository
     * @param TagRepository $tagRepository
     */
    public function __construct(DistributorRepository $distributorRepository,
                                PublicationRepository $publicationRepository,
                                GameRepository $gameRepository,
                                TagRepository $tagRepository)
    {
        parent::__construct();

        $this->distributorRepository = $distributorRepository;
        $this->publicationRepository = $publicationRepository;
        $this->gameRepository = $gameRepository;
        $this->tagRepository = $tagRepository;
    }

    /**
     * Retorna todas as distribuidoras de conteúdo.
     *
     * @return View
     */
    public function index()
    {
        $distributors = $this->distributorRepository->getPaging();

        return view('cpanel.distributors.index', compact('distributors'));
    }

    /**
     * Visão geral das distribuidoras de conteúdo.
     *
     * @return View
     */
    public function overview()
    {
        return view('cpanel.distributors.overview');
    }

    /**
     * Retorna uma distribuidora cadastrada.
     *
     * @param Distributor $distributor
     * @return View
     */
    public function show(Distributor $distributor)
    {
        return view('cpanel.distributors.show', compact('distributor'));
    }

    /**
     * Formulário para criação de uma nova distribuidora.
     *
     * @return View
     */
    public function create()
    {
        return view('cpanel.distributors.create');
    }

    /**
     * Adiciona uma nova distribuidora.
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
     * Formulário para edição de uma dada distribuidora.
     *
     * @param Distributor Distributor
     * @return View
     */
    public function edit(Distributor $distributor)
    {
        return view('cpanel.distributors.edit', compact('distributor'));
    }

    /**
     * Realiza a atualização de uma dada distribuidora.
     *
     * @param DistributorUpdateRequest $request
     * @param Distributor $distributor
     * @return Redirect
     */
    public function update(DistributorUpdateRequest $request, Distributor $distributor)
    {
        if ($this->distributorRepository->update($request->all(), $distributor)) {
            multi_alerts()->success('distributors.successfully_updated', [ 'name' => $distributor->name ])->put();

            return to('CPanel\DistributorController@edit', $distributor->id);
        }

        multi_alerts()->danger('distributors.update_fail')->put();

        return retry();
    }

    /**
     * Faz a exclusão de uma dada distribuidora.
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

    public function spilgames()
    {
        //
        // Adiciona as tags...
        //

        $tags = $this->publicationRepository->findByDistributorId(self::SPILGAMES_ID, 'TAG');

        foreach ($tags as $t) {
            $slug = str_slug($t->name);

            $tag = $this->tagRepository->findBySlug($slug);

            if (! empty($tag)) {
                continue;
            }

            $this->tagRepository->store([
                'name' => $t->name,
                'slug' => str_slug($t->name),
                'thumbnail' => '',
                'is_visible' => 0
            ]);
        }

        //
        // Adiciona os jogos...
        //

        $games = $this->publicationRepository->findByDistributorId(self::SPILGAMES_ID, 'GAME');

        foreach ($games as $g) {
            $slug = str_slug($g->name);

            $game = $this->gameRepository->findBySlug($slug);

            if (! empty($game)) {
                continue;
            }

            //
            // PASSO 1) Faz download da miniatura
            //

            $thumbnail = '';

            $remoteFile = get_remote_file($g->data['thumbnail']);

            if (! empty($remoteFile)){
                $location = sprintf('%s/%s', uplab_dir(), $remoteFile->name);

                storage()->put($location, $remoteFile->contents);

                $thumbnail = uplab($location)->getObject();
            }

            //
            // PASSO 2) Salva o jogo no banco de dados
            //

            $game = $this->gameRepository->store([
                'name' => $g->name,
                'slug' => str_slug($g->name),
                'age_range' => 'NOT_SPECIFIED',
                'description' => $g->data['description'],
                'embed' => [
                    'url' => $g->data['url'],
                    'type' => 'INSIDE'
                ],
                'dimensions' => [
                    'is_responsive' => 1,
                    'width' => $g->data['width'],
                    'height' => $g->data['height'],
                    'aspect_ratio' => ''
                ],
                'thumbnail' => $thumbnail,
                'is_visible' => 1,
                'published_at' => Carbon::now()
            ]);

            //
            // PASSO 3) Adiciona as tags
            //

            $tags = [];

            if (! empty($g->data['category'])) {
                $slug = str_slug($g->data['category']);

                $tag = $this->tagRepository->findBySlug($slug);

                $tags[] = $tag->id;
            }

            if (! empty($g->data['subcategory'])) {
                $slug = str_slug($g->data['subcategory']);

                $tag = $this->tagRepository->findBySlug($slug);

                $tags[] = $tag->id;
            }

            $game->tags()->sync($tags);
        }

        return to('CPanel\GameController@index');
    }
}
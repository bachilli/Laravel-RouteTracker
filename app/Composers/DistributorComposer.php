<?php

namespace App\Composers;

use App\Models\Distributor;
use App\Repositories\Distributor\DistributorRepository;

class DistributorComposer
{
    /**
     * Repositório da entidade tags.
     *
     * @var DistributorRepository
     */
    private $distributorRepository;

    /**
     * Construtor da página inicial do site.
     *
     * @param DistributorRepository $distributorRepository
     */
    public function __construct(DistributorRepository $distributorRepository)
    {
        $this->distributorRepository = $distributorRepository;
    }

    /**
     * ...
     *
     * @param $view
     */
    public function compose($view)
    {
        $distributors = $this->distributorRepository->getAll();

        $view->with('distributors', $distributors);
    }
}
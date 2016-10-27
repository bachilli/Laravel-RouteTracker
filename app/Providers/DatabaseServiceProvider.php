<?php

namespace App\Providers;

use App\Repositories\Publication\PublicationRepository;
use App\Repositories\Publication\EloquentPublicationRepository;
use App\Repositories\Game\EloquentGameRepository;
use App\Repositories\Game\GameRepository;
use App\Repositories\Distributor\EloquentDistributorRepository;
use App\Repositories\Distributor\DistributorRepository;
use App\Repositories\Tag\EloquentTagRepository;
use App\Repositories\Tag\TagRepository;
use Illuminate\Support\ServiceProvider;

class DatabaseServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PublicationRepository::class, EloquentPublicationRepository::class);
        $this->app->bind(GameRepository::class, EloquentGameRepository::class);
        $this->app->bind(DistributorRepository::class, EloquentDistributorRepository::class);
        $this->app->bind(TagRepository::class, EloquentTagRepository::class);
    }
}
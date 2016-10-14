<?php

namespace App\Providers;

use App\Repositories\Content\ContentRepository;
use App\Repositories\Content\EloquentContentRepository;
use App\Repositories\Game\EloquentGameRepository;
use App\Repositories\Game\GameRepository;
use App\Repositories\Source\EloquentSourceRepository;
use App\Repositories\Source\SourceRepository;
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
        $this->app->bind(ContentRepository::class, EloquentContentRepository::class);
        $this->app->bind(GameRepository::class, EloquentGameRepository::class);
        $this->app->bind(SourceRepository::class, EloquentSourceRepository::class);
        $this->app->bind(TagRepository::class, EloquentTagRepository::class);
    }
}
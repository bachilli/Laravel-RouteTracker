<?php

namespace App\Providers;

use App\Repositories\Category\CategoryCrudRepository;
use App\Repositories\Category\CategoryFetchRepository;
use App\Repositories\Category\EloquentCategoryCrudRepository;
use App\Repositories\Category\EloquentCategoryFetchRepository;
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
        $this->app->bind(CategoryCrudRepository::class, EloquentCategoryCrudRepository::class);
        $this->app->bind(CategoryFetchRepository::class, EloquentCategoryFetchRepository::class);
    }
}
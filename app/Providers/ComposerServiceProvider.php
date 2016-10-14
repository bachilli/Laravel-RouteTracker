<?php

namespace App\Providers;

use App\Composers\GameClassificationComposer;
use App\Composers\GameEmbedTypeComposer;
use App\Composers\GameTypeComposer;
use App\Composers\YesOrNoComposer;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // ...
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->view->share('pageTitle', '');
        $this->app->view->share('metaDescription', '');

        //
        // Games / CPanel
        //

        $this->app->view->composer([
            'cpanel.games.create',
            'cpanel.games.edit'
        ], GameTypeComposer::class);

        $this->app->view->composer([
            'cpanel.games.create',
            'cpanel.games.edit'
        ], GameEmbedTypeComposer::class);

        $this->app->view->composer([
            'cpanel.games.create',
            'cpanel.games.edit'
        ], GameClassificationComposer::class);

        $this->app->view->composer([
            'cpanel.games.create',
            'cpanel.games.edit'
        ], YesOrNoComposer::class);
    }
}
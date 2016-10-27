<?php

namespace App\Providers;

use App\Composers\Game\AgeRangeComposer as GameAgeRangeComposer;
use App\Composers\Game\EmbedTypeComposer as GameEmbedTypeComposer;
use App\Composers\Game\TagComposer as GameTagComposer;
use App\Composers\YesOrNoComposer;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $compositions['primary.*'] = [ GameTagComposer::class ];

        $compositions['cpanel.tags.create'] = [ YesOrNoComposer::class ];

        $compositions['cpanel.tags.edit'] = [ YesOrNoComposer::class ];

        $compositions['cpanel.games.create'] = [
            GameEmbedTypeComposer::class,
            GameAgeRangeComposer::class,
            YesOrNoComposer::class,
            GameTagComposer::class
        ];

        $compositions['cpanel.games.edit'] = [
            GameEmbedTypeComposer::class,
            GameAgeRangeComposer::class,
            YesOrNoComposer::class,
            GameTagComposer::class
        ];

        foreach ($compositions as $view => $composers) {
            $this->dataShare($composers, $view);
        }
    }

    /**
     * ...
     *
     * @param $composers
     * @param $view
     * @return void
     */
    private function dataShare($composers, $view)
    {
        foreach ($composers as $composer) {
            $this->app->view->composer($view, $composer);
        }
    }
}
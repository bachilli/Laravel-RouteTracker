<?php

/*
 * This file is part of Laravel-Tracker.
 *
 * (c) Gustavo Meireles <gustavo@gsmeira.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GSMeira\LaravelTracker;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('gsmeira/tracker.php'),
        ]);
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('laravel-tracker', function ($app) {
            $namespace = $app->config->get('gsmeira.tracker.controllers_namespace', 'App\Http\Controllers');

            return new LaravelTracker($namespace);
        });
    }
}
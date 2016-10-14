<?php

/*
 * This file is part of Laravel-Tracker.
 *
 * (c) Gustavo Meireles <gustavo@gsmeira.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use GSMeira\LaravelTracker\LaravelTracker;

if (! function_exists('tracker')) {
    /**
     * Returns an instance of Laravel-Tracker.
     *
     * @param array $routes
     * @return LaravelTracker
     */
    function tracker($routes = [])
    {
        return app('laravel-tracker')->setRoutes($routes);
    }
}
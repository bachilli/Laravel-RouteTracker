<?php

/*
 * This file is part of Laravel-RouteTracker.
 *
 * (c) Gustavo Meireles <gustavo@gsmeira.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use GSMeira\LaravelRouteTracker\LaravelRouteTracker;

if (! function_exists('tracker')) {
    /**
     * Returns an instance of Laravel-RouteTracker.
     *
     * @param array $routes
     * @return LaravelRouteTracker
     */
    function tracker($routes = [])
    {
        return app('laravel-routetracker')->setRoutes($routes);
    }
}
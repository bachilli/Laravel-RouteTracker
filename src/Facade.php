<?php

/*
 * This file is part of Laravel-RouteTracker.
 *
 * (c) Gustavo Meireles <gustavo@gsmeira.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GSMeira\LaravelRouteTracker;

use Illuminate\Support\Facades\Facade as BaseFacade;

/**
 * This is the Laravel-RouteTracker facade class.
 *
 * @author Gustavo Meireles <gustavo@gsmeira.com>
 * @package GSMeira\LaravelRouteTracker
 */
class Facade extends BaseFacade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-routetracker';
    }
}
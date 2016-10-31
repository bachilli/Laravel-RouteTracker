<?php

namespace GSMeira\LaravelRouteTracker;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

class LaravelRouteTracker
{
    /**
     * Routes to be analysed.
     *
     * @var array
     */
    private $routes;

    /**
     * Controllers namespace.
     *
     * @var string
     */
    private $namespace;

    /**
     * Stores the accessed action.
     *
     * @var string
     */
    private $currentAction;

    /**
     * Stores the accessed controller.
     *
     * @var string
     */
    private $currentController;

    /**
     * Stores the accessed method.
     *
     * @var string
     */
    private $currentMethod;

    /**
     * True if the accessed route is in the $routes array.
     *
     * @var bool
     */
    private $isCurrent;

    /**
     * Laravel-RouteTracker class constructor.
     *
     * @param array $namespace
     * @return void
     */
    public function __construct($namespace)
    {
        $this->namespace = $namespace;

        $this->currentAction = call_user_func(function()
        {
            if (Route::currentRouteAction() != null) {
                $remove_namespace = str_replace($this->namespace, '', Route::currentRouteAction());

                return trim($remove_namespace, '\\');
            } else {
                return Request::capture()->getRequestUri();
            }
        });

        if (stristr($this->currentAction, '@') !== false) {
            list($this->currentController, $this->currentMethod) = explode('@', $this->currentAction);
        }
    }

    /**
     * Checks if the route being accessed is contained in the analyzed routes.
     *
     * @param $actions
     * @return bool
     */
    private function isCurrent($actions)
    {
        foreach ($actions as $action)
        {
            if(stristr($action, '@') !== false) {
                list($controller, $method) = explode('@', $action);

                if ($method == '*') {
                    if ($this->currentController == $controller) {
                        return true;
                    }
                }
                else {
                    if (strpos($method, '|') !== false) {
                        $methods = explode('|', $method);

                        foreach ($methods as $m) {
                            if ($this->currentMethod == $m) {
                                return true;
                            }
                        }
                    }
                    else {
                        if ($this->currentAction == $action) {
                            return true;
                        }
                    }
                }
            } else {
                if ($action == Request::capture()->getRequestUri()) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Returns the action being accessed.
     *
     * @return string
     */
    public function getCurrentAction()
    {
        return $this->currentAction;
    }

    /**
     * Returns the controller being accessed.
     *
     * @return string
     */
    public function getCurrentController()
    {
        return $this->currentController;
    }

    /**
     * Returns the method that is being accessed.
     *
     * @return string
     */
    public function getCurrentMethod()
    {
        return $this->currentMethod;
    }

    /**
     * Defines the routes requested for analysis.
     *
     * @param $routes
     * @return $this
     */
    public function setRoutes($routes)
    {
        $this->routes = $routes;

        $this->isCurrent = $this->isCurrent($routes);

        return $this;
    }

    /**
     * If it is the current route returns the string.
     *
     * @param $str
     * @return string
     */
    public function ifIsCurrentOutput($str)
    {
        if ($this->isCurrent) {
            return $str;
        }

        return '';
    }
}
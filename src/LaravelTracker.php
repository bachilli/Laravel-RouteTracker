<?php

namespace GSMeira\LaravelTracker;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

class LaravelTracker
{
    private $routes;

    /**
     * Namespace dos controladores.
     *
     * @var string
     */
    private $namespace;

    /**
     * Action acessada.
     *
     * @var string
     */
    private $currentAction;

    /**
     * Controller acessado.
     *
     * @var string
     */
    private $currentController;

    /**
     * Método acessado.
     *
     * @var string
     */
    private $currentMethod;

    /**
     *
     *
     * @var bool
     */
    private $isCurrent;

    /**
     * Construtor do componente Tracker.
     *
     * @param array $namespace
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
     * Verifica se a action que é acessada está contida
     * no array de actions passado por parâmetro.
     *
     * @param $actions
     * @return bool
     */
    private function isCurrent($actions)
    {
        foreach ($actions as $action)
        {
            // Rota via Controller
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
     * Retorna a action que está sendo acessada.
     *
     * @return string
     */
    public function getCurrentAction()
    {
        return $this->currentAction;
    }

    /**
     * Retorna o controller que está sendo acessado.
     *
     * @return string
     */
    public function getCurrentController()
    {
        return $this->currentController;
    }

    /**
     * Retorna o método que está sendo acessado.
     *
     * @return string
     */
    public function getCurrentMethod()
    {
        return $this->currentMethod;
    }

    /**
     * Define as rotas solicitadas para análise.
     *
     * @param $routes
     */
    public function setRoutes($routes)
    {
        $this->routes = $routes;

        $this->isCurrent = $this->isCurrent($routes);

        return $this;
    }

    /**
     * Se for a rota corrente retorna a string.
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
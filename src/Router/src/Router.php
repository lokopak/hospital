<?php

namespace Dotpak\Hospital\Router;

use Dotpak\Hospital\Http\RequestInterface;
use Exception;

class Router implements RouterInterface
{
    /**
     * Valid aplication routes.
     * 
     * @var Route[]
     */
    protected $routes;

    /**
     * 
     */
    public function __construct()
    {
        $routes = (array) require __DIR__ . '/../config/router.config.php';

        if (!is_array($routes) || !isset($routes['router'])) {
            throw new Exception("No routes config provided");
        }

        $this->setRoutes($this->parse($routes['router']));
    }

    protected function parse(array $data)
    {
        if (!isset($data['routes']) || !is_array($data['routes'])) {
            throw new Exception("Empty routes config provided");
        }
        $routes = [];

        foreach ($data['routes'] as $key => $routeData) {
            $routeData['name'] = $key;
            $route = new Route($routeData);

            $routes[$route->getName()] = $route;
        }

        return $routes;
    }

    /**
     * 
     */
    protected function setRoutes(array $routes)
    {
        $this->routes = $routes;
    }

    /**
     * 
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * 
     */
    public function getRoute(string $routeName)
    {
        if (isset($this->routes[$routeName])) {
            return $this->routes[$routeName];
        }

        return null;
    }


    public function hasRoute(string $uri)
    {
        foreach ($this->routes as $key => $value) {
            if (preg_match("#^" . $value->getRoute() . "$#", $uri)) {
                return $key;
            }
        }

        return false;
    }

    public function attach(string $routeName)
    {
        if (!isset($this->routes[$routeName])) {
            throw new Exception("Route $routeName not found");
        }
        $this->attachedRoute = $this->routes[$routeName];
    }

    public function dispatch(RequestInterface $request)
    {
        $controller = $this->attachedRoute->getController();
        print_r("<pre>");
        print_r($controller);
        print_r("</pre>");

        if (class_exists($controller)) {
            $controller = new $controller($request);
            $action = $this->attachedRoute->getAction();
            $controller->$action();
        }
    }
}
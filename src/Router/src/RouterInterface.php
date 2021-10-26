<?php

namespace Dotpak\Hospital\Router;

use Dotpak\Hospital\Http\RequestInterface;

interface RouterInterface
{
    /**
     * 
     */
    public function getRoutes();

    /**
     * 
     */
    public function getRoute(string $routeName);

    public function hasRoute(string $uri);

    public function attach(string $route);

    public function dispatch(RequestInterface $request);
}
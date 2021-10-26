<?php

namespace Dotpak\Hospital\Router;

use InvalidArgumentException;

class Route
{
    /**
     * Route name (identifier)
     * 
     * @var string
     */
    protected $name;

    /**
     * Route 
     * 
     * @var string
     */
    protected $route;

    /**
     * Controller
     * 
     * @var string
     */
    protected $controller;

    /**
     * Action
     * 
     * @var string
     */
    protected $action;

    /**
     * Constructor
     */
    public function __construct(array $data)
    {
        if (!isset($data['name']) || !isset($data['route']) || !isset($data['controller']) || !isset($data['action'])) {
            throw new InvalidArgumentException("Invalid route schema");
        }

        $name = trim($data['name']);
        if (empty($name)) {
            throw new InvalidArgumentException("Invalid route name");
        }
        $this->setName($name);

        $route = trim($data['route']);
        if (empty($route)) {
            throw new InvalidArgumentException("Invalid route ");
        }
        $this->setRoute($route);

        $controller = trim($data['controller']);
        if (empty($controller)) {
            throw new InvalidArgumentException("Invalid route ");
        }
        $this->setController($controller);

        $action = trim($data['action']);
        if (empty($action)) {
            throw new InvalidArgumentException("Invalid route ");
        }
        $this->setAction($action);
    }

    /**
     * 
     */
    protected function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * 
     */
    protected function setRoute(string $route)
    {
        $this->route = $route;
    }

    /**
     * 
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * 
     */
    protected function setController(string $controller)
    {
        $this->controller = $controller;
    }

    /**
     * 
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * 
     */
    protected function setAction(string $action)
    {
        $this->action = $action;
    }

    /**
     * 
     */
    public function getAction()
    {
        return $this->action;
    }
}
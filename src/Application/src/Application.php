<?php

namespace Dotpak\Hospital\Mvc;

use Dotpak\Hospital\Http\Request;
use Dotpak\Hospital\Router\Router;
use Dotpak\Hospital\Router\RouterInterface;

class Application
{
    /**
     * 
     */
    protected static $application;

    /**
     * Router instance.
     * 
     * @var \Dotpak\Hospital\Router\RouterInterface
     */
    protected $router;


    /**
     * 
     */
    protected $request;

    /**
     * Constructor
     */
    private function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    /**
     * 
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

    public function getRequest()
    {
        return $this->request;
    }

    /**
     * 
     */
    public static function getApplication()
    {
        if (!self::$application) {
            self::$application = new Application(new Router());
        }

        return self::$application;
    }

    public function setRouter(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function getRouter()
    {
        return $this->router;
    }

    public function run()
    {
        if (($route = $this->router->hasRoute($this->request->getUri()))) {
            $this->router->attach($route, $this->request);

            return $this->router->dispatch($this->request);
        }
    }

    /**
     * 
     */
    public static function init()
    {
        $application = self::getApplication();

        $application->setRequest(new Request());

        $application->setRouter(new Router());

        return $application;
    }
}
<?php

namespace Dotpak\Hospital\Router;


return [
    'router' => [
        'routes' => [
            'home' => [
                'type' => 'Literal',
                'route' => '/',
                'controller' => \Dotpak\Hospital\Mvc\Controller\IndexController::class,
                'action' => 'index',
            ],
        ],
    ],
];
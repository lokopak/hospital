<?php

use Dotpak\Hospital\Mvc\Application;
use Dotpak\Hospital\Router\Router;

require __DIR__ . '/../vendor/autoload.php';

if (!class_exists(Application::class)) {
    throw new RuntimeException("La aplicación no ha podido cargarse correctamente.");
}

$application = Application::init();

$application->run();
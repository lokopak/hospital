<?php

namespace Dotpak\Hospital\Mvc\Controller;

class IndexController
{

    public function index()
    {
        $contenido = __DIR__ . "/../../view/ejemplos.php";

        return require_once(__DIR__ . "/../../view/pagina.phtml");
    }
}
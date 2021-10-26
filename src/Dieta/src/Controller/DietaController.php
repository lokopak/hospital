<?php

namespace Dotpak\Hospital\Dieta\Controller;

class DietaController
{
    protected $tabla;

    public function __construct()
    {

        $dietas = require(__DIR__ . "/config/dietas.config.php");
    }

    public function index()
    {
        $contenido = __DIR__ . "/view/index.phtml";

        return require_once(__DIR__ . "/../view/pagina.phtml");
    }
}
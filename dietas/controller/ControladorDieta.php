<?php

require_once __DIR__ . "/../../controller/Controlador.php";

class ControladorDieta extends Controlador
{

    /**
     * Muestra la página con el listado de dietas
     */
    public function index()
    {
        require_once(__DIR__ . "/../model/TablaDieta.php");
        require_once(__DIR__ . "/../../login/services/Autorizacion.php");

        if (!Autorizacion::getInstancia()->tieneIdentidad()) {
            header("location: /login/login.php");
            exit();
        }

        $dietas = TablaDieta::getInstancia()->getDietas();

        $this->setPlantilla("index");

        return $this->mostrarHtml([
            'dietas' => $dietas,
        ]);
    }
}
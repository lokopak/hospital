<?php

namespace Dotpak\Hospital\Empleado\Controller;

use Dotpak\Hospital\Empleado\Model\TablaEmpleado;

class EmpleadoController
{

    protected $tabla;

    public function __construct()
    {

        $this->tabla = new TablaEmpleado();
    }

    public function index()
    {
        // Realizamos la consulta para buscar el listado de empleados pasándole sólo las columnas que queremos/necesitamos mostrar.
        $empleados = $this->tabla->buscarTodos(['id', 'nombre', 'apellidos', 'DNI', 'cargo']);

        // Guardamos el path al archivo que tiene el contenido de la página.
        // NOTA: como la llamada / require al archivo con la plantilla de la página se hace desde aquí, guardamos el path en relación a este archivo.
        $contenido = __DIR__ . "/view/index.phtml";

        // Y mostramos la página entera.
        return require(__DIR__ . "/../view/pagina.phtml");
    }
}
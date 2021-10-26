<?php

namespace Dotpak\Hospital\Paciente;

use Dotpak\Hospital\Paciente\Model\TablaPaciente;

class PacienteController
{
    protected $conexion;

    public function __construct()
    {
        // Creamos la interface con la tabla pacientes
        $this->conexion = new TablaPaciente();
    }

    /**
     * 
     */
    public function index()
    {
        // Realizamos la consulta para buscar el listado de pacientes pasándole sólo las columnas que queremos/necesitamos mostrar.
        $pacientes = $this->conexion->buscarTodos(['id', 'nombre', 'apellidos', 'habitacion', 'dieta', 'estado', 'fechaRegistro', 'fechaSalida']);

        // Guardamos el path al archivo que tiene el contenido de la página.
        // NOTA: como la llamada / require al archivo con la plantilla de la página se hace desde aquí, guardamos el path en relación a este archivo.
        $contenido = __DIR__ . "/view/index.phtml";

        // Y mostramos la página entera.
        return require(__DIR__ . "/../view/pagina.phtml");
    }
}
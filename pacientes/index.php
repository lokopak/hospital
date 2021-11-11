<?php

require_once(__DIR__ . "/../login/services/Autorizacion.php");
require_once(__DIR__ . "/../login/services/ControlAcceso.php");

if (!Autorizacion::getInstancia()->tieneIdentidad()) {
    header("location: /login/login.php");
}

require_once(__DIR__ . "/model/TablaPaciente.php");

if (!(ControlAcceso::tieneAcceso('INFORMES@VER') || ControlAcceso::tieneAcceso('INFORMES@VER_PROPIOS'))) {
    header("location: /login/no-autorizado.php");
}

/**
 * Este archivo funciona como controlador de la página de inicio de pacientes.
 */

// Creamos la interface con la tabla pacientes
$conexion = new TablaPaciente();

// Realizamos la consulta para buscar el listado de pacientes pasándole sólo las columnas que queremos/necesitamos mostrar.
$pacientes = $conexion->buscarTodos(['id', 'nombre', 'apellidos', 'habitacion', 'dieta', 'estado', 'fechaRegistro', 'fechaSalida', 'fechaNacimiento']);

// Guardamos el path al archivo que tiene el contenido de la página.
// NOTA: como la llamada / require al archivo con la plantilla de la página se hace desde aquí, guardamos el path en relación a este archivo.
$contenido = __DIR__ . "/view/index.phtml";

// Y mostramos la página entera.
return require(__DIR__ . "/../view/pagina.phtml");
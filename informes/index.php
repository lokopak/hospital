<?php
require_once(__DIR__ . "/../login/services/Autorizacion.php");

// Sesion::getInstancia()->sesionIniciada();

if (!Autorizacion::getInstancia()->tieneIdentidad()) {
    header("location: /login/login.php");
}

require_once(__DIR__ . "/model/TablaInforme.php");
require_once(__DIR__ . "/../services/AppError.php");
require_once(__DIR__ . "/../services/Peticion.php");
require_once(__DIR__ . "/../services/Sesion.php");



/**
 * Este archivo funciona como controlador de la página de inicio de informes.
 */

// Creamos la interface con la tabla informes
$conexion = new TablaInforme();

$idPaciente = Peticion::getInstancia()->fromGet('idPaciente');

// Si se ha proporcionado id del paciente, nos aseguramos que se trata con el tipo de variable correcto.
if (null !== $idPaciente) {
    $idPaciente = (int) $idPaciente;
}

// Realizamos la consulta para buscar el listado de informes pasándole sólo las columnas que queremos/necesitamos mostrar.
$informes = $conexion->buscarTodos($idPaciente);

if ($informes instanceof AppError) {
    return $informes->mostrarError();
}

// Guardamos el path al archivo que tiene el contenido de la página.
// NOTA: como la llamada / require al archivo con la plantilla de la página se hace desde aquí, guardamos el path en relación a este archivo.
$contenido = __DIR__ . "/view/index.phtml";

// Y mostramos la página entera.
require(__DIR__ . "/../view/pagina.phtml");
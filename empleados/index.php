<?php

require_once(__DIR__ . "/../login/services/Autorizacion.php");
require_once(__DIR__ . "/../login/services/ControlAcceso.php");
require_once __DIR__ . "/../services/Peticion.php";
require_once __DIR__ . "/../services/paginador/Paginador.php";

if (!Autorizacion::getInstancia()->tieneIdentidad()) {
    header("location: /login/login.php");
}
if (!(ControlAcceso::tieneAcceso('EMPLEADOS@VER'))) {
    header("location: /login/no-autorizado.php");
}

require_once(__DIR__ . "/model/TablaEmpleado.php");

/**
 * Este archivo funciona como controlador de la página de inicio de empleados.
 */

// Creamos la interface con la tabla empleados
$conexion = new TablaEmpleado();

// Realizamos la consulta para buscar el listado de empleados pasándole sólo las columnas que queremos/necesitamos mostrar.
$elementos = $conexion->buscarTodos(['id', 'nombre', 'apellidos', 'DNI', 'cargo']);

// Si se ha producido algún error durante la conexión con la base de datos, mostramos la página de error.
if ($elementos instanceof AppError) {
    return $resultado->mostrarError();
}

$pagina = Peticion::getInstancia()->fromGet('pagina');
if (is_null($pagina)) {
    $pagina = 1;
}

$limite = Peticion::getInstancia()->fromGet('limite');
if (is_null($limite)) {
    $limite = 20;
}

$elementos = new Paginador($elementos, $pagina, $limite);

// Guardamos el path al archivo que tiene el contenido de la página.
// NOTA: como la llamada / require al archivo con la plantilla de la página se hace desde aquí, guardamos el path en relación a este archivo.
$contenido = __DIR__ . "/view/index.phtml";

// Y mostramos la página entera.
return require(__DIR__ . "/../view/pagina.phtml");
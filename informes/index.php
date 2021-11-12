<?php
require_once(__DIR__ . "/../login/services/Autorizacion.php");

// Sesion::getInstancia()->sesionIniciada();

if (!Autorizacion::getInstancia()->tieneIdentidad()) {
    header("location: /login/login.php");
}

require_once(__DIR__ . "/../login/services/ControlAcceso.php");

if (!(ControlAcceso::tieneAcceso('INFORMES@VER') || ControlAcceso::tieneAcceso('INFORMES@VER_PROPIOS'))) {
    header("location: /login/no-autorizado.php");
}

require_once(__DIR__ . "/../login/services/Autentificacion.php");
$empleado = Autentificacion::getInstancia()->usuarioActual();

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

$pagina = Peticion::getInstancia()->fromGet('pagina');
if (null === $pagina) {
    $pagina = 1;
}
$limite = Peticion::getInstancia()->fromGet('limite');
if (null === $limite) {
    $limite = 20;
}
$ordenPor = Peticion::getInstancia()->fromGet('ordenPor');
if (null === $ordenPor) {
    $ordenPor = 'id';
}
$busqueda = ['limite' => $limite, 'pagina' => $pagina, 'ordenPor' => $ordenPor];
// Si no puede ver todos los informes, sólo mostramos los que son creados por el empleado
if (!ControlAcceso::tieneAcceso('INFORMES@VER')) {

    $busqueda['idEmpleado'] = $empleado->getId();
}

// Realizamos la consulta para buscar el listado de informes pasándole sólo las columnas que queremos/necesitamos mostrar.
$resultado = $conexion->buscarTodos($idPaciente, $busqueda, true);

if ($resultado instanceof AppError) {
    return $resultado->mostrarError();
}

// Guardamos el path al archivo que tiene el contenido de la página.
// NOTA: como la llamada / require al archivo con la plantilla de la página se hace desde aquí, guardamos el path en relación a este archivo.
$contenido = __DIR__ . "/view/index.phtml";

// Y mostramos la página entera.
require(__DIR__ . "/../view/pagina.phtml");
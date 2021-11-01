<?php
require_once(__DIR__ . "/../services/Peticion.php");
require_once(__DIR__ . "/model/TablaEmpleado.php");
require_once(__DIR__ . "/model/Empleado.php");
require_once(__DIR__ . "/../services/AppError.php");

if (Peticion::getInstancia()->esPost()) {

    // Recogemos todos los datos desde el POST
    $datos = Peticion::getInstancia()->fromPost();

    // El resto de valores debe ser un integer.
    $datos['cargo'] = (int) $datos['cargo'];

    $tablaEmpelados = new TablaEmpleado();

    $idEmpleado = $tablaEmpelados->insertar($datos);

    if ($idEmpleado > 0) {
        header("Location: /empleados/editar.php?idEmpleado=" . $idEmpleado);
    } else {
        return AppError::error('Error inesperado', 'No se ha podido crear el nuevo empleado.');
    }
}
$cargos = Empleado::getCargosDisponibles();
$contenido = __DIR__ . "/view/crear.phtml";

require_once(__DIR__ . "/../view/pagina.phtml");
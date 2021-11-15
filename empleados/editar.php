<?php

require_once(__DIR__ . "/../login/services/Autorizacion.php");
require_once __DIR__ . "/../services/AppError.php";
require_once(__DIR__ . "/../login/services/ControlAcceso.php");

if (!Autorizacion::getInstancia()->tieneIdentidad()) {
    header("location: /login/login.php");
    exit();
}
if (!(ControlAcceso::tieneAcceso('EMPLEADOS@EDITAR'))) {
    header("location: /login/no-autorizado.php");
    exit();
}

require_once(__DIR__ . "/../services/Peticion.php");
require_once(__DIR__ . "/model/TablaEmpleado.php");
require_once(__DIR__ . "/model/Empleado.php");
$tablaEmpelados = new TablaEmpleado();

if (Peticion::getInstancia()->esPost()) {

    // Recogemos todos los datos desde el POST
    $datos = Peticion::getInstancia()->fromPost();


    // El resto de valores debe ser un integer.
    $datos['cargo'] = (int) $datos['cargo'];

    $idEmpleado = (int) $datos['idEmpleado'];
    unset($datos['idEmpleado']);

    $resultado = $tablaEmpelados->actualizar($idEmpleado, $datos);

    if ($resultado instanceof AppError) {
        $resultado->mostrarError();
    }
    if ($idEmpleado == null) {
        echo " ERROR";
    }
    $datosEmpleado = $tablaEmpelados->buscarUno($idEmpleado);
    if ($datosEmpleado == null) {
        echo " ERROR";
    } else {
        $empleado = new Empleado();
        $empleado->rellenarConArray($datosEmpleado);
    }

    if ($resultado) {
    } else {
        echo '
        <div class="alert alert-warning" role="alert">
          Algo ha fallado.
        </div>';
    }
} else {
    $idEmpleado = Peticion::getInstancia()->fromGet("idEmpleado");
    if ($idEmpleado == null) {
        echo " ERROR";
    }
    $datosEmpleado = $tablaEmpelados->buscarUno($idEmpleado);
    if ($datosEmpleado == null) {
        echo " ERROR";
    } else {
        $empleado = new Empleado();
        $empleado->rellenarConArray($datosEmpleado);
    }
}
$cargos = Empleado::getCargosDisponibles();
$contenido = __DIR__ . "/view/editar.phtml";
require_once(__DIR__ . "/../view/pagina.phtml");
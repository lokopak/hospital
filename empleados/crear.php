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
    $password = Peticion::getInstancia()->fromPost("userPassword");
    $confirm_password = Peticion::getInstancia()->fromPost("confirm_password");
    unset($datos['confirm_password']);
    $username_err = $password_err = $login_err = "";

    if ($password === null) {
        $password_err = "Por favor, introduzca un password.";
    } elseif (strlen($password) < 6) {
        $password_err = "La contraseña debe tener al menos seis caracteres.";
    } else {
        $password = $password;
    }

    if (empty($confirm_password)) {
        $confirm_password_err = "Por favor, confirma el password.";
    } else {
        $confirm_password = $confirm_password;
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Las contraseñas no coinciden.";
        }
    }

    //if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {
        $datos['userPassword'] = password_hash($password, PASSWORD_DEFAULT);
    //}

    $tablaEmpelados = new TablaEmpleado();
    
    $idEmpleado = $tablaEmpelados->insertar($datos);
        if ($idEmpleado instanceof AppError){
            $idEmpleado-> mostrarError();
        }

    if ($idEmpleado > 0) {
        // header("Location: /empleados/editar.php?idEmpleado=" . $idEmpleado);
    } else {
        return AppError::error('Error inesperado', 'No se ha podido crear el nuevo empleado.');
    }
}
$cargos = Empleado::getCargosDisponibles();
$contenido = __DIR__ . "/view/crear.phtml";

require_once(__DIR__ . "/../view/pagina.phtml");

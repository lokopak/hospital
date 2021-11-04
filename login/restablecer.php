<?php
require_once(__DIR__ . "/../services/Peticion.php");
require_once(__DIR__ . "/../services/Sesion.php");
require_once(__DIR__ . "/../empleados/model/TablaEmpleado.php");
require_once(__DIR__ . "/../empleados/model/Empleado.php");
$tablaEmpelados = new TablaEmpleado();
if (Peticion::getInstancia()->esPost()) {
    $newPasswordErr = $newConfirmPasswordErr = $usuarioErr = $loginErr = "";

    $usuario = Peticion::getInstancia()->fromPost("userName");
    if ($usuario === null || empty($usuario)) {
        $usuarioErr = "Por favor, introduzca un usuario correcto.";
    } else {
        $usuario = $tablaEmpelados->buscarUno($usuario, 'DNI', ['id']);

        if (null === $usuario) {
            $usuarioErr = "El usuario no existe.";
        }
    }

    if (empty($usuarioErr)) {
        $newConfirmPassword = Peticion::getInstancia()->fromPost("newConfirmPassword");
        $newPassword = Peticion::getInstancia()->fromPost("newPassword");

        if ($newPassword === null || empty($newPassword)) {
            $newPasswordErr = "Por favor, introduzca la nueva contraseña.";
        } elseif ($newPassword < 6) {
            $newPasswordErr = "La contraseña tiene que tener al menos 6 caracteres.";
        }

        if ($newConfirmPassword === null || empty($newConfirmPassword)) {
            $newConfirmPasswordErr = "Por favor repita la contraseña.";
        } else if (($newPassword != $newConfirmPassword)) {
            $newConfirmPasswordErr = "Las contraseñas no coinciden.";
        }


        if (empty($newPasswordErr) && empty($newConfirmPasswordErr)) {

            $paramPassword = password_hash($newPassword, PASSWORD_DEFAULT);


            if ($tablaEmpelados->actualizar($usuario['id'], ['userPassword' => $paramPassword]) === true) {

                session_destroy();
                header("location: /login/login.php");
                exit();
            } else {

                return (new AppError('Petición no válida', 'No se ha proporcionado los datos necesarios'))->mostrarError();
            }
        }
    }
    
}
require_once(__DIR__ . "/view/restablecer.phtml");
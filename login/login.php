<?php
require_once(__DIR__ . "/../services/Peticion.php");

require_once(__DIR__ . "/../login/services/Autorizacion.php");
require_once(__DIR__ . "/../empleados/model/TablaEmpleado.php");

if (Autorizacion::getInstancia()->tieneIdentidad()) {
    // El usuario ya está identificado. Prevenimos el reloging.
    header("location: /index.php");
}

if (Peticion::getInstancia()->esPost()) {
    $username = $password = "";
    $userNameErr = $passwordErr = $loginErr = "";
    $password = Peticion::getInstancia()->fromPost("userPassword");
    $username = Peticion::getInstancia()->fromPost("username");

    if ($username === null) {
        $userNameErr = "Por favor, introduzca el usuario.";
    } else {
        $username = $username;
    }

    if ($password === null) {
        $passwordErr = "Por favor introduzca el password.";
    } else {
        $password = $password;
    }

    if (empty($userNameErr) && empty($passwordErr)) {
        $userData = (new TablaEmpleado())->buscarUno($username, 'DNI', ['id', 'DNI', 'userPassword']);

        // Se ha producido un error en la conexión
        if ($userData instanceof AppError) {
            return $userData->mostrarError();
        }

        require_once __DIR__ . "/services/Autorizacion.php";
        $resultado = Autorizacion::getInstancia()->login($username, $password);

        if ($resultado instanceof AppError) {
            return $resultado->mostrarError();
        }

        if (isset($resultado['resultado']) && $resultado['resultado'] === true) {
            header("location: /index.php");
        } else {
            $loginErr = "Usuario o contraseña incorrectos.";
        }
    } else {
        $loginErr = "Usuario o contraseña incorrectos.";
    }
}

require(__DIR__ . "/view/login.phtml");
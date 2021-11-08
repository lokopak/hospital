<?php
require_once(__DIR__ . "/../model/ConexionDB.php");
require_once(__DIR__ . "/../services/Peticion.php");

require_once(__DIR__ . "/../login/services/Autorizacion.php");

// Sesion::getInstancia()->sesionIniciada();

if (Autorizacion::getInstancia()->tieneIdentidad()) {
    // El usuario ya está identificado. Prevenimos el reloging.
    header("location: /index.php");
}


if (Peticion::getInstancia()->esPost()) {
    $conexion = ConexionDB::getConexion();
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

        $sql = "SELECT id, DNI, userPassword FROM empleados WHERE DNI = :DNI";

        if ($stmt = $conexion->prepare($sql)) {

            $stmt->bindParam(":DNI", $paramUsername, PDO::PARAM_STR);

            $paramUsername = $username;

            if ($stmt->execute()) {

                if ($stmt->rowCount() == 1) {
                    if ($row = $stmt->fetch()) {
                        $id = $row["id"];
                        $username = $row["DNI"];
                        $hashedPassword = $row["userPassword"];
                        require_once __DIR__ . "/services/Autorizacion.php";
                        $resultado = Autorizacion::getInstancia()->login($username, $password);

                        if ($resultado instanceof AppError) {
                            return $resultado->mostrarError();
                        }

                        if (isset($resultado['resultado']) && $resultado['resultado'] === true) {
                            // require_once(__DIR__ . "/../services/Sesion.php");
                            // Sesion::getInstancia()->iniciarSesion(true, $id, $username);
                            header("location: /index.php");
                        } else {

                            $loginErr = "Usuario o contraseña incorrectos.";
                        }
                    }
                } else {
                    $loginErr = "Usuario o contraseña incorrectos.";
                }
            } else {
                echo "Alguna cosa ha ido muy mal.";
            }


            unset($stmt);
        }
    }


    unset($conexion);
}

require(__DIR__ . "/view/login.phtml");
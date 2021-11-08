<?php
require_once(__DIR__ . "/../model/ConexionDB.php");
require_once(__DIR__ . "/../services/Peticion.php");



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

                        if (password_verify($password, $hashedPassword)) {
                            require_once(__DIR__ . "/../services/Sesion.php");
                            Sesion::getInstancia()->iniciarSesion(true, $id, $username);

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
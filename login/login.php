<?php
require_once(__DIR__ . "/../model/ConexionDB.php");
require_once(__DIR__ . "/../services/Peticion.php");



if (Peticion::getInstancia()->esPost()) {
    $conexion = ConexionDB::getConexion();
    $username = $password = "";
    $username_err = $password_err = $login_err = "";
    $password = Peticion::getInstancia()->fromPost("userPassword");
    $username = Peticion::getInstancia()->fromPost("username");

    if ($username === null) {
        $username_err = "Por favor, introduzca el usuario.";
    } else {
        $username = $username;
    }


    if ($password === null) {
        $password_err = "Por favor introduzca el password.";
    } else {
        $password = $password;
    }

    if (empty($username_err) && empty($password_err)) {

        $sql = "SELECT id, DNI, userPassword FROM empleados WHERE DNI = :DNI";

        if ($stmt = $conexion->prepare($sql)) {

            $stmt->bindParam(":DNI", $param_username, PDO::PARAM_STR);

            $param_username = $username;

            if ($stmt->execute()) {

                if ($stmt->rowCount() == 1) {
                    if ($row = $stmt->fetch()) {
                        $id = $row["id"];
                        $username = $row["DNI"];
                        $hashed_password = $row["userPassword"];

                        if (password_verify($password, $hashed_password)) {
                            require_once(__DIR__ . "/../services/Sesion.php");
                            Sesion::iniciarSesion(true,$id,$username);

                            header("location: /index.php");
                        } else {

                            $login_err = "Usuario o contraseña incorrectos.";
                        }
                    }
                } else {
                    $login_err = "Usuario o contraseña incorrectos.";
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
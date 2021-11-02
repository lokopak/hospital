<?php
require_once(__DIR__ . "/../model/ConexionDB.php");
require(__DIR__ . "/view/login.php");
session_start();
 
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}
$conexion= ConexionDB::getConexion();

$username = $password = "";
$username_err = $password_err = $login_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($_POST["username"]))){
        $username_err = "Por favor, introduzca el usuario.";
    } else{
        $username = trim($_POST["username"]);
    }
    

    if(empty(trim($_POST["password"]))){
        $password_err = "Por favor introduzca el password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    if(empty($username_err) && empty($password_err)){

        $sql = "SELECT id, username, password FROM users WHERE username = :username";
        
        if($stmt = $conexion->prepare($sql)){

            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            
            $param_username = trim($_POST["username"]);
            
            if($stmt->execute()){

                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $id = $row["id"];
                        $username = $row["username"];
                        $hashed_password = $row["password"];
                        if(password_verify($password, $hashed_password)){
                            session_start();
                        
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            header("location: index.php");
                        } else{

                            $login_err = "Usuario o contraseña incorrectos.";
                        }
                    }
                } else{
                    $login_err = "Usuario o contraseña incorrectos.";
                }
            } else{
                echo "Alguna cosa ha ido muy mal.";
            }


            unset($stmt);
        }
    }
    

    unset($conexion);
}
?>

require(__DIR__ . "/view/login.php");
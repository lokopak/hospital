<?php
class Sesion
{

    public static function sesionIniciada()
    {
        // Initialize the session
        if (static::sesionEmpezada() == FALSE) {
            session_start();
        }

        // Comprueba si el usuario esta logeado, si no esta logeado se carga la parte del login
        if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
            header("location: /login/login.php");
            exit;
        }
    }
    private static function sesionEmpezada()
    {
        return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
    }
    public static function iniciarSesion($loggedin, $id, $username)
    {
        session_set_cookie_params(3600);
        session_start();

        $_SESSION["loggedin"] = $loggedin;
        $_SESSION["id"] = $id;
        $_SESSION["username"] = $username;
    }
    public static function desconectar()
    {
        session_start();
        $_SESSION = array();
        session_destroy();
    }
}

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
}

<?php
class Sesion
{

    /**
     * Instancia única de esta clase.
     * 
     * @var \Autentificacion
     */
    protected static $instancia;

    /**
     * Constructor.
     * 
     * Declarado privado para evitar crear objetos de esta clase.
     */
    private function __construct()
    {
    }

    /**
     * Devuelve la única instancia de esta clase.
     * En caso de no haberse creado ya, esta será creada.
     * 
     * @return Sesion
     */
    public static function getInstancia()
    {
        // Si no está creada, la creamos primero.
        if (!self::$instancia) {
            self::$instancia = new Sesion();
        }

        // Devolvemos la instancia.
        return self::$instancia;
    }

    public function sesionIniciada()
    {
        // Initialize the session
        if ($this->sesionEmpezada() == FALSE) {
            session_start();
        }

        // Comprueba si el usuario esta logeado, si no esta logeado se carga la parte del login
        if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
            header("location: /login/login.php");
            exit;
        }
    }
    private function sesionEmpezada()
    {
        return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
    }
    public function iniciarSesion($loggedin, $id, $username)
    {
        session_set_cookie_params(3600);
        session_start();

        $_SESSION["loggedin"] = $loggedin;
        $_SESSION["id"] = $id;
        $_SESSION["username"] = $username;
    }
    public function desconectar()
    {
        session_start();
        $_SESSION = array();
        session_destroy();
    }
}
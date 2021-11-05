<?php

require_once __DIR__ . "/Autentificacion.php";

/**
 * Esta clase se encarga de gestionar y realizar
 * los intentos de login y logut de la aplicación.
 */
class Autorizacion
{
    /**
     * Servicio que se encargará de realizar las autentificaciones.
     * 
     * @var \Autentificacion
     */
    protected $autentificador;

    /**
     * Instancia única de esta clase.
     * 
     * @var \Autorizacion
     */
    protected static $instancia;

    /**
     * Constructor.
     * 
     * Declarado privado para evitar crear objetos de esta clase.
     */
    private function __construct()
    {
        // Obtenemos el servicio encargado de llevar a cabo la autentificación.
        $this->setAutentificador();
    }

    /**
     * Devuelve la única instancia de esta clase.
     * En caso de no haberse creado ya, esta será creada.
     * 
     * @return Autorizacion
     */
    public static function getInstancia()
    {
        // Si no está creada, la creamos primero.
        if (!self::$instancia) {
            self::$instancia = new Autorizacion();
        }

        // Devolvemos la instancia.
        return self::$instancia;
    }

    /**
     * Fija el autentificador para realizar el login.
     * 
     * @return void
     */
    public function setAutentificador()
    {
        // Si ya está fijado el autentificador, no es necesario volver a hacerlo.
        if (!$this->autentificador) {
            $this->autentificador = Autentificacion::getInstancia();
        }
    }

    /**
     * Realiza un intento de login.
     * 
     * @return mixed
     */
    public function login($username, $password)
    {
        // TODO: COMPROBAR SI EL USUARIO YA ESTÁ LOGEADO PARA EVITAR DOBLE LOGIN.

        // Devolvemos el resultado optenido de la autentificación del usuario.
        return $this->autentificador->autentificar($username, $password);
    }

    /**
     * Realiza un intento de logout
     * 
     * @return
     */
    public function logout()
    {
        // TODO: Optimizar
        require_once(__DIR__ . "/../../services/Sesion.php");

        Sesion::getInstancia()->desconectar();
    }

    /**
     * Esta función comprueba si el usuario tiene acceso a cierto recurso dentro de la aplicación.
     */
    public function tieneAcceso($empleado, $permiso)
    {
        return true;
    }
}
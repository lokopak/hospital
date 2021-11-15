<?php

require_once __DIR__ . "/../../services/Sesion.php";
require_once __DIR__ . "/../../sesion/service/ContenedorSesion.php";
require_once __DIR__ . "/../../empleados/model/TablaEmpleado.php";

class Autentificacion
{
    /**
     * Contenedor con los datos relativos a la identidad del usuario.
     * 
     * @var \ContenedorSesion
     */
    protected $contenedor;

    /**
     * Instancia única de esta clase.
     * 
     * @var \Autentificacion
     */
    protected static $instancia;

    /**
     * Campo de la tabla de empleados usada como identificador.
     * 
     * @var string
     */
    protected $columnaIdentificacion = 'DNI';

    /**
     * Datos del usuario actualmente logeado.
     * 
     * @var Empleado
     */
    protected $usuarioActual;

    /**
     * Constructor.
     * 
     * Declarado privado para evitar crear objetos de esta clase.
     */
    private function __construct()
    {
        // Creamos el contenedor que tendrá los datos de la sesión.
        $this->contenedor = new ContenedorSesion('AppAuth', Sesion::getInstancia());
    }

    /**
     * Devuelve la única instancia de esta clase.
     * En caso de no haberse creado ya, esta será creada.
     * 
     * @return Autentificacion
     */
    public static function getInstancia()
    {
        // Si no está creada, la creamos primero.
        if (!self::$instancia) {
            self::$instancia = new Autentificacion();
        }

        // Devolvemos la instancia.
        return self::$instancia;
    }

    /**
     * Realiza un intento de login.
     * 
     * Devuelve un array con dos ídices:
     * 
     * 
     * @param string $username Nombre de usuario
     * @param string $password Contraseña
     * 
     * @return mixed
     * 
     */
    public function autentificar($username, $password)
    {
        // Recordamos que cada acción que tenga que ver con la base de datos, debe ir en un bloque try-catch para evitar filtraciones de datos.
        try {
            // Esta tabla solo nos hace falta en esta función, al menos de momento.
            require_once __DIR__ . "/../../empleados/model/TablaEmpleado.php";
            require_once __DIR__ . "/../../empleados/model/Empleado.php";

            $tablaEmpleados = new TablaEmpleado();

            /**
             * Extraemos los datos necesarios para realizar el login. Necesitamos el cargo para comprobar que el usuario está activado.
             */
            $usuario = $tablaEmpleados->buscarUno($username, $this->columnaIdentificacion, ['id', 'DNI', 'nombre', 'apellidos', 'userPassword', 'cargo']);

            // Si se ha producido un error en la base de datos, simplemente devolvemos el error.
            if ($usuario instanceof AppError) {
                return $usuario;
            }

            // Si el usuario no existe en la base de datos, no se puede hacer nada.
            if (null === $usuario || false === $usuario) {
                // Devolvemos este mensaje para evitar dar pistas de si el usuario existe o no.
                return ['resultado' => false, 'mensaje' => 'El usuario o contraseña incorrecto'];
            }

            // Comprobamos que el usuario está activado y tiene acceso a la aplicación.
            if ($usuario['cargo'] === Empleado::CARGO_EMPLEADO_INACTIVO) {
                // Alguna ha liado el empleado y no tiene acceso... se lo decimos para que sienta la presión...
                return ['resultado' => false, 'mensaje' => 'Este usuario no tiene acceso actualmente. Pongase en contacto con los administradores del sistema.'];
            }

            // Comprobamos que las contraseñas concuerdan.
            if (password_verify($password, $usuario['userPassword'])) {
                // Agregamos la identidad del usuario a almacenamiento de la sesión.
                $this->contenedor->agregar('username', $username);
                $this->usuarioActual = new Empleado();
                unset($usuario['userPassword']);
                $this->usuarioActual->rellenarConArray($usuario);
                // Login correcto, adelante!!!
                return ['resultado' => true, 'mensaje' => 'Autentificación correcta'];
            }

            // De nuevo, si la contraseña no es correcta, mostramos el mismo mensaje para no dar pistas.
            return ['resultado' => false, 'mensaje' => 'El usuario o contraseña incorrecto'];
        } catch (Exception $e) {
            return new AppError("Error inesperado", "Se ha producido un error grave y no se ha podido llevar a cabo la acción solicitada.");
        }
    }

    /**
     * Desconecta al usuario de la aplicación.
     * 
     * @return void
     */
    public function desconectar()
    {
        $this->contenedor->vaciar();
    }

    /**
     * Comprueba si el usuario está identificado en la aplicación
     * 
     * @return bool
     */
    public function identificado()
    {
        return !$this->contenedor->vacio();
    }

    /**
     * Devuelve la identidad del usuario.
     * 
     * @return mixed
     */
    public function obtenerIdentidad()
    {
        if ($this->contenedor->vacio()) {
            return null;
        }

        return $this->contenedor->leer();
    }

    /**
     * Devuelve los datos del usuario actual.
     * 
     * @return \Empleado
     */
    public function usuarioActual()
    {
        if (isset($this->usuario)) {
            return $this->usuario;
        }

        if ($this->identificado()) {
            $identidad = $this->obtenerIdentidad();
            $tablaEmpleados = new TablaEmpleado();
            $datosUsuario = $tablaEmpleados->buscarUno($identidad['username'], $this->columnaIdentificacion, ['id', 'DNI', 'nombre', 'apellidos', 'cargo']);

            if ($datosUsuario === null || $datosUsuario === false) {
                throw new Exception("No se ha encontrado el usuario con este nombre de usuario");
            }

            $this->usuarioActual = new Empleado();
            $this->usuarioActual->rellenarConArray($datosUsuario);

            return $this->usuarioActual;
        }

        return null;
    }
}
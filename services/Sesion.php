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
     * Enlace directo con la super global $_SESSION para aceso controlado.
     * 
     * @var \ArrayObject
     */
    protected $sesion;

    /**
     * Constructor.
     * 
     * Declarado privado para evitar crear objetos de esta clase.
     */
    private function __construct()
    {
        $datosViejos = [];

        // Cogemos todos los datos de $_SESSION
        if (isset($_SESSION)) {
            $datosViejos = $_SESSION;

            // Si la sesión ya ha sido creada anteriormente
            if ($datosViejos instanceof ArrayObject) {
                $datosViejos = $datosViejos->toArray();
            }
        }

        // Iniciazliamos las sesiones.
        session_start();

        // Si la sesión contenia datos antiguos, combinamos los datos antiguos con los nuevos.
        if (!empty($datosViejos) && is_array($datosViejos)) {
            $_SESSION = $this->combinarDatos($datosViejos, $_SESSION);
        }


        // Iniciamos los datos del contenedor, el array y demás incluidos en este.
        // Aquí queremos que los valores se guarden como propiedades del objeto y que el iterador de este sea un ArrayIterator.
        $this->sesion = new ArrayObject($_SESSION, ArrayObject::ARRAY_AS_PROPS, '\\ArrayIterator');

        // Ahora convertimos el super global $_SESSION en este objeto, de forma que podamos interactuar directamente con ella de forma segura.
        $_SESSION = $this->sesion;

        register_shutdown_function([$this, 'grabarAlCerrar']);
    }

    /**
     * Comprueba si la sesión cotiene un determinado índice.
     * 
     * @param string $nombre
     * 
     * @return bool
     */
    public function contiene($nombre)
    {
        return $this->sesion->offsetExists($nombre);
    }

    /**
     * Devuelve los datos de una entrada almacenados en la sesión.
     * 
     * @param string $nombre Nombre del campo.
     * 
     * @return mixed
     */
    public function obtener($nombre)
    {
        if ($this->sesion->offsetExists($nombre)) {
            return $this->sesion->offsetGet($nombre);
        }

        return null;
    }

    /**
     * Agrega una nueva entrada en los campos de la sesión.
     * 
     * @param string $nombre Nombre del campo.
     * @param mixed $datos Datos que contienene el nuevo campo.
     * 
     * @return void
     */
    public function agregar($nombre, $datos)
    {
        $this->sesion->offsetSet($nombre, $datos);
    }

    /**
     * Actualiza los datos de un campo de la sesión.
     * 
     * @param string $nombre Nombre del campo.
     * @param mixed $datos Datos a actualizar.
     * 
     * @return void
     */
    public function actualizar($nombre, $datos)
    {
        // El campo indicado no existe, no se puede hacer nada.
        if (!$this->sesion->offsetExists($nombre)) {
            return;
        }

        // Recogemos los datos ya almacenados en el campo.
        $datosViejos = $this->sesion->offsetGet($nombre);

        // Combinamos los datos nuevos con los antiguos, actualizando las entradas ya existentes.
        $datos = $this->combinarDatos($datosViejos, $datos);

        // Guardamos los nuevos datos en la sesion
        $this->sesion->offsetSet($nombre, $datos);
    }

    /**
     * Combina los datos de una sesión previa con los de una sesión nueva.
     * Lo raliza de forma recursiva en caso de ser necesario.
     * 
     * @param array $a array con los datos antiguos
     * @param array $b array con los datos nuevos.
     * 
     * @return array El resultado de la combinación de datos.
     */
    private function combinarDatos($a, $b)
    {
        // Recorremos todos los valores de $b para insertarlos/sustituir los valores en $a
        foreach ($b as $indice => $valor) {
            // Si el indice ya existe en $b, lo sustituimos
            if (isset($a[$indice]) || array_key_exists($indice, $a)) {
                // El nuevo valor es un array y el viejo son un array? Mejor asignamos de forma recursiva cada valor.
                if (is_array($valor) && is_array($a[$indice])) {
                    $a[$indice] = $this->combinarDatos($a[$indice], $valor);
                }
                // En caso contrario, simplemente sustituimos.
                else {
                    $a[$indice] = $valor;
                }
            }
            // Si no existe, simplemente le asignamos el nuevo valor.
            else {
                $a[$indice] = $valor;
            }
        }

        return $a;
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

    /**
     * Elimina el contenido de una entrada concreta dentro de los datos de la sesión.
     * 
     * @param string $nombre
     * 
     * @return void
     */
    public function eliminar($nombre)
    {
        // Si el elemento existe, lo borramos.
        if ($this->sesion->offsetExists($nombre)) {
            $this->sesion->offsetUnset($nombre);
        }
    }

    /**
     * Vacía todos los datos de la sesión.
     * 
     * @return void
     */
    public function vaciarSesion()
    {
        // Si la sesión no está empezada, no hay nada que hacer.
        if (!$this->sesionEmpezada()) {
            return;
        }

        session_destroy();

        $this->sesion = new ArrayObject([], ArrayObject::ARRAY_AS_PROPS, '\\ArrayIterator');
    }


    public function sesionIniciada()
    {
        // Initialize the session
        if ($this->sesionEmpezada() === false) {
            session_start();
        }

        // Comprueba si el usuario esta logeado, si no esta logeado se carga la parte del login
        if (!$this->sesion->offsetExists("loggedin") || $this->sesion->offsetGet("loggedin") !== true) {
            header("location: /login/login.php");
            exit;
        }
    }

    /**
     * Comprueba si la sesión ha sido ya iniciada.
     * 
     * @return bool
     */
    private function sesionEmpezada()
    {
        return session_status() === PHP_SESSION_ACTIVE ? true : false;
    }

    public function iniciarSesion($loggedin, $id, $username)
    {
        session_set_cookie_params(3600);
        session_start();

        $this->sesion->offsetSet("loggedin", $loggedin);
        $this->sesion->offsetSet("id", $id);
        $this->sesion->offsetSet("username", $username);
    }

    /**
     * Desconecta al usuario y destruye los datos de la sesión.
     * 
     * @return void;
     */
    public function desconectar()
    {
        // Si la sesión no está empezada, no hay nada que hacer.
        if (!$this->sesionEmpezada()) {
            return;
        }

        session_destroy();

        $this->sesion = new ArrayObject([], ArrayObject::ARRAY_AS_PROPS, '\\ArrayIterator');
    }

    /**
     * Graba la sesión al cerrar 
     */
    public function grabarAlCerrar()
    {
        $_SESSION = $this->sesion->getArrayCopy();

        session_write_close();

        $this->sesion = new ArrayObject($_SESSION, ArrayObject::ARRAY_AS_PROPS, '\\ArrayIterator');
    }
}
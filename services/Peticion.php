<?php

/**
 * La clase Petición se encarga de tener acceso a la
 * solicitud del cliente y a los distintos datos que 
 * se reciben meciante los disintos métodos http.
 * 
 */
class Peticion
{

    /**
     * Para facilitar la comprobación del método de la petición
     * 
     * @var string
     */
    protected $metodo = 'GET';

    /**
     * Almacena todos los datos que se reciben
     * en el método GET
     * 
     * @var ArrayObject
     */
    protected $get;

    /**
     * Almacena todos los datos que se reciben
     * en el método POST
     * 
     * @var ArrayObject
     */
    protected $post;

    /** 
     * Instancia única de esta clase.
     * 
     * @var Peticion
     */
    protected static $instance = null;

    /**
     * TODO: Agregar otros métodos si son necesrios.
     */

    /**
     * Constructor.
     */
    private function __construct()
    {
        $this->metodo = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';

        // Si hay get:
        if ($_GET) {
            $this->setGet($_GET);
        }

        if ($_POST) {
            $this->setPost($_POST);
        }
    }

    /**
     * Devuelve la únca instancia que se puede crear de esta
     * clase. Crea la instancia en caso de no haberse creado ya.
     */
    public static function getInstancia()
    {
        if (!static::$instance) {
            static::$instance = new Peticion();
        }

        return static::$instance;
    }

    /**
     * Recoge todos los valores que vienen desde el método GET.
     * 
     * @param array $post Valores recividos.
     * 
     * @return void
     */
    private function setGet($get)
    {
        $this->get = new ArrayObject($get, ArrayObject::ARRAY_AS_PROPS);
    }

    /**
     * Devuelve los valores recibidos en el método GET, si los hay.
     * Si se proporciona el nombre del parámetro, devuelve sólo
     * el valor de ese parámetro.
     * Si se proporciona un valor por defecto, en caso de no encontrar
     * el parámetro indicado devolverá ese valor.
     * 
     * @param string $nombre [opcional] Nombre del parámetro
     * @param mixed $defecto [opcional] Valor por defecto en caso de no encontrarse el valor solicitado.
     */
    public function fromGet($nombre = null, $defecto = null)
    {
        if ($this->get === null) {
            $this->get = new ArrayObject();
        }

        if ($nombre === null) {
            return $this->get->getArrayCopy();
        }

        if ($this->get->offsetExists($nombre)) {
            return $this->get->offsetGet($nombre);
        }

        return $defecto;
    }

    /**
     * Recoge todos los valores que vienen desde el método POST
     */
    private function setPost($post)
    {
        $this->post = new ArrayObject($post, ArrayObject::ARRAY_AS_PROPS);
    }

    /**
     * Devuelve los valores recibidos en el método POST, si los hay.
     * Si se proporciona el nombre del parámetro, devuelve sólo
     * el valor de ese parámetro.
     * Si se proporciona un valor por defecto, en caso de no encontrar
     * el parámetro indicado devolverá ese valor.
     * 
     * @param string $nombre [opcional] Nombre del parámetro
     * @param mixed $defecto [opcional] Valor por defecto en caso de no encontrarse el valor solicitado.
     */
    public function fromPost($nombre = null, $defecto = null)
    {
        if ($this->post === null) {
            $this->post = new ArrayObject();
        }

        if ($nombre === null) {
            return $this->post->getArrayCopy();
        }

        if ($this->get->offsetExists($nombre)) {
            return $this->post->offsetGet($nombre);
        }

        return $defecto;
    }

    /**
     * Devuelve el método de la petición actual.
     * 
     * @return string.
     */
    public function getMetodo()
    {
        return $this->metodo;
    }

    /**
     * Comprueba si el método empleado en la Request
     * es POST
     * 
     * @return boolean Resultado de la comprobación.
     */
    public function esPost()
    {
        return $this->metodo === 'POST';
    }
}
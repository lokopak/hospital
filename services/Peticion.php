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
     * Url a la que se raliza la peticion.
     * 
     * @var string
     */
    protected $uri;

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
        // Guardamos el método recibido para facilitar acceder a él.
        $this->metodo = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';

        // Recogemos la url de la petición.
        $this->setUri(isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '');

        // Si hay get, recogemos los parámetros recividos.
        if ($_GET) {
            $this->setGet($_GET);
        }

        // Si hay post, recogemos los parámetros recividos.
        if ($_POST) {
            $this->setPost($_POST);
        }
    }

    /**
     * Devuelve la únca instancia que se puede crear de esta
     * clase. Crea la instancia en caso de no haberse creado ya.
     * 
     * @return Peticion
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
     * @param array $post Valores recividos en la query de la url.
     * 
     * @return void
     */
    private function setGet($get)
    {
        $this->get = new ArrayObject($get, ArrayObject::ARRAY_AS_PROPS);
    }

    /**
     * Fija el valor de la uri de la petición.
     * 
     * @param string $uri
     * 
     * @return void
     */
    private function setUri($uri)
    {
        $this->uri = (string) $uri;
    }

    /**
     * Devuelve la url de la peitición.
     * 
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
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
        // Si no se ha recibido GET, devolvemos un array vacío.
        if ($this->get === null) {
            // Creamos un array vacío para prevenir errores.
            $this->get = new ArrayObject();
        }

        // Si no se ha indicado nombre del parámetro, devolemos una copia del array entero.
        if ($nombre === null) {
            return $this->get->getArrayCopy();
        }

        // Si se ha proporcionado nombre de parámetro y el parámetro se encuentra en el array del post, lo devolvemos.
        if ($this->get->offsetExists($nombre)) {
            return $this->get->offsetGet($nombre);
        }

        // En caso contrario, devolvemos valor por defecto 
        return $defecto;
    }

    /**
     * Recoge todos los valores que vienen desde el método POST
     * 
     * @param mixed $post El array que contiene el POST recibido en la petición.
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
        // Si no se ha recibido POST, devolvemos un array vacío.
        if ($this->post === null) {
            // Creamos un array vacío para prevenir errores.
            $this->post = new ArrayObject();
        }

        // Si no se ha indicado nombre del parámetro, devolemos una copia del array entero.
        if ($nombre === null) {
            return $this->post->getArrayCopy();
        }

        // Si se ha proporcionado nombre de parámetro y el parámetro se encuentra en el array del post, lo devolvemos.
        if ($this->post->offsetExists($nombre)) {
            return $this->post->offsetGet($nombre);
        }

        // En caso contrario, devolvemos valor por defecto 
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
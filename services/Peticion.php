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
     * TODO: Agregar otros métodos si son necesrios.
     */

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->metodo = isset($_REQUEST['REQUEST_METHOD']) ? $_REQUEST['REQUEST_METHOD'] : 'GET';

        // Si hay get:
        if ($_GET) {
            $this->setGet($_GET);
        }

        if ($_POST) {
            $this->setPost($_POST);
        }
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
     * Obtiene un parámetro del método GET.
     */
    public function fromGet($nombre = null, $defecto = null)
    {
        if ($this->get === null) {
            $this->get = new ArrayObject();
        }

        if ($nombre === null) {
            return $this->post;
        }

        if ($this->get->offsetExists($nombre)) {
            return $this->post->offsetGet($nombre);
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
}
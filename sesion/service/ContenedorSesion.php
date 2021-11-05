<?php

/**
 * Esta clase nos permitirá agrupar todos los datos de forma más eficiente.
 * Ayudará a mantener todos los datos separados por 'categorías' y el acceso
 * a ellos sin que se pueda acceder a los demás.
 */
class ContenedorSesion extends ArrayObject
{
    /**
     * Nombre del contenedor. Se almacenarán los datos que este contenga
     * bajo este parámetro dentro del array $_SESSION.
     * 
     * @var string
     */
    protected $nombre;

    /**
     * Clase encargada de gestionar las sesiones.
     * 
     * @var \Sesion
     */
    protected $sesion;

    /**
     * Constructor
     * 
     * @param string $nombre Nombre del contenedor bajo el cual se guardarán los datos.
     * @param Sesion $sesion El objeto encargado de gestionar las sesiones.
     */
    public function __construct($nombre, $sesion)
    {
        $this->setNombre($nombre);
        $this->setSesion($sesion);

        print_r($this->sesion);
        $datos = [];
        // Si existen datos de este contenedor en la sesión, los recogemos.
        if ($this->sesion->contiene($this->nombre)) {
            $datos = $this->sesion->obtener($this->nombre);
        }

        parent::__construct($datos, ArrayObject::ARRAY_AS_PROPS);
    }

    /**
     * Devuelve el nombre del contenedor.
     * 
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Fija el nombre del contenedor.
     * 
     * @param string $nombre
     * 
     * @return void
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * Fija el objeto que se encarga de getionar las sesiones.
     * 
     * @param Sesion $sesion
     * 
     * @return void
     */
    protected function setSesion($sesion)
    {
        $this->sesion = $sesion;
    }

    /**
     * Vaciamos los datos de este contenedor, eliminando los datos de la
     * sesión.
     * 
     * @return void
     */
    public function vaciar()
    {
        // Eliminamos los datos de la sesión.
        $this->sesion->eliminar($this->nombre);
        // Eliminamos los datos almacenados en este contenedor.
        $this->exchangeArray([]);
    }

    /**
     * Comprueba si el contenedor vacio (no contiene ningún dato)
     * 
     * @return bool
     */
    public function vacio()
    {
        return !isset($this->sesion->{$this->name});
    }

    /**
     * Guarda un valor en el contendor.
     * 
     * Los valores en el contenedor se guardar serializados para optimizar su uso.
     * 
     * @param string $nombre Nombre del indice
     * @param mixed $valor El valor a guardar en el contenedor.
     * 
     * @return void
     */
    public function agregar($nombre, $valor)
    {
        $this->offsetSet($nombre, serialize($valor));

        // Nos aseguramos que la sesión guarda los valores de este contenedor.

        if ($this->sesion->contiene($this->nombre)) {
            $this->sesion->actualizar($this->nombre, $this->getArrayCopy());
        } else {
            $this->sesion->agregar($this->nombre, $this->getArrayCopy());
        }
    }
}
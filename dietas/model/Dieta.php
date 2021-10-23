<?php

class Dieta
{
    /**
     * Nombre de la dieta.
     * Hace las veces de identificador.
     * 
     * @var string
     */
    protected $nombre;

    /**
     * Breve descripción de esta dieta.
     * 
     * @var string
     */
    protected $descripcion;

    /**
     * Dietas hijas (variantes) de esta dieta.
     * 
     * @var Dieta[]
     */
    protected $hijas = [];

    /**
     * Dieta madre de esta dieta.
     * Esta dienta es una variante de la dieta madre.
     * 
     * @var Dieta
     */
    protected $madre;

    /**
     * Constructor
     * 
     * @param string $nombre Nombre (identificador) de la dieta
     * @param string $descripcion Breve descripción de la dieta
     * @param Dieta|null $madre [opcional] Dieta madre de esta dieta.
     * @param Dieta[]|null $hijas [opcional] Dietas hija de esta dieta.
     */
    public function __construct($nombre, $descripcion, $hijas = [], $madre = null)
    {
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->madre = $madre;
        $this->hijas = $hijas;
    }

    /**
     * Devuelve el nombre de la dieta.
     * 
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Ajusta el nombre de la dieta.
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
     * Devuelve la descripción de la dieta
     * 
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Ajusta la descripción de la dieta.
     * 
     * @param string $descripcion
     * 
     * @return void
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /**
     * Devuelve la dieta madre de esta dieta.
     * 
     * @return Dieta|null
     */
    public function getMadre()
    {
        return $this->madre;
    }

    /**
     * Ajusta la dieta madre de esta dieta.
     * 
     * @param Dieta $madre La nueva dieta madre.
     * 
     * @return void
     */
    public function setMadre($madre)
    {
        $this->madre = $madre;
    }

    /**
     * Devuelve las dietas hijas de esta dieta.
     * 
     * @return Dieta[]
     */
    public function getHijas()
    {
        return $this->hijas;
    }

    /**
     * Ajusta las dietas hijas de esta dieta.
     * 
     * @param Dieta[] $hijas El array con las hijas de la dieta.
     * 
     * @return void
     */
    public function setHijas($hijas)
    {
        $this->hijas = $hijas;
    }

    /**
     * Agrega una hija a esta dienta.
     * 
     * @param Dieta $hija La nueva hija a agregar al
     *          array de hijas de esta dieta.
     * 
     * @return boolean Devuelve true si la dieta
     *      no existe ya en el grupo de hijas y se 
     *      ha agregado correctamente.
     *      Devuelve false si la dieta ya existe
     *      entre las dietas hijas de esta dieta.
     */
    public function agregarHija($hija)
    {
        // La dieta ya es hija de esta dieta.
        if (in_array($hija->getNombre(), $this->hijas)) {
            return false;
        }

        $this->hijas[$hija->getNombre()] = $hija;
    }

    /**
     * Retira una dieta hija del listado de dietas 
     * hijas de esta dieta.
     * 
     * @return Dieta $hija La dieta hija a retirar.
     * 
     * @return boolean Devuelve true si la dieta
     *          se encuentra entre las dietas hijas
     *          de esta dieta y se ha eliminado
     *          correctamente.
     *          Devuelve false si la dieta no estaba
     *          entre las dietas hijas.
     */
    public function retirarHija($hija)
    {
        if (!in_array($hija->getNombre(), $this->hijas)) {
            return false;
        }

        unset($this->hijas[$hija->getNombre()]);
        return false;
    }
}
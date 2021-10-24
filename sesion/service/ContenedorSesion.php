<?php

/**
 * Esta clase nos permitirá agrupar todos los datos de forma más eficiente.
 * Ayudará a mantener todos los datos separados por 'categorías' y el acceso
 * a ellos sin que se pueda acceder a los demás.
 */
class ContenedorSesion
{
    /**
     * Nombre del contenedor. Se almacenarán los datos que este contenga
     * bajo este parámetro dentro del array $_SESSION.
     */
    protected $nombre;

    /**
     * Un array con todos los datos guardados en este contenedor.
     */
    protected $datos = [];

    /**
     * Constructor
     */
    public function __construct($nombre)
    {
        $this->nombre = $nombre;
    }
}
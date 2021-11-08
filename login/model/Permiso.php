<?php

/**
 * Esta clase representa a cada uno de los distitos permisos que
 * puede haber en la aplicación.
 */
class Permiso
{
    /**
     * El grupo o modulo al que afecta el permiso
     * 
     * @var string
     */
    protected $modulo;

    /**
     * La acción a la que afecta el permiso
     * 
     * @var string
     */
    protected $accion;

    /**
     * Constructor
     * 
     * @param string $modulo Modulo al que afecta el permiso
     * @param string $accion Accion a la que afecta el permiso.
     */
    public function __construct($modulo, $accion)
    {
        $this->modulo = $modulo;
        $this->accion = $accion;
    }

    /**
     * Devuelve el modulo al que afecta el permiso.
     * 
     * @return string
     */
    public function getModulo()
    {
        return $this->modulo;
    }

    /**
     * Fija el valor del modulo al que afecta el permiso
     * 
     * @param string $modulo
     * 
     * @return void
     */
    public function setModulo($modulo)
    {
        $this->modulo = $modulo;
    }

    /**
     * Devuelve la acción a la que afecta el permiso.
     * 
     * @return string
     */
    public function getAccion()
    {
        return $this->accion;
    }

    /**
     * Fija la acción a la que afecta el permiso
     * 
     * @param string $acccion
     */
    public function setAccion($accion)
    {
        $this->accion = $accion;
    }
}
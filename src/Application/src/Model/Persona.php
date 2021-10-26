<?php

namespace Dotpak\Hospital\Mvc\Model;

/**
 * Clase que sirve de base para todas las entidades
 * de la base de datos que pueden / deben ser consideradas
 * como personas y por tanto heredar de esta.
 * 
 * Se define como abstracta dado que no se espera que
 * exista ningún objeto de esta clase.
 */
abstract class Persona extends Entidad
{
    /**
     * Nombre de la persona
     * 
     * @var string
     */
    protected $nombre;

    /**
     * Apellidos de la persona.
     * 
     * @var string
     */
    protected $apellidos;

    /**
     * Devuelve el nombre de la persona
     * 
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Cambia el nombre de la persona
     * 
     * @param string $nombre El nuevo nombre de la persona
     * 
     * @return void
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * Devuelve los apellidos de la persona.
     * 
     * @return string
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Cambia los apellidos de la persona.
     * 
     * @param string $apellidos Los nuevos apellidos de la persona
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    }
}
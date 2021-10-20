<?php

abstract class Entidad
{
    protected $id;

    protected $noRellenar = [
        'id'
    ];

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Rellena los campos de una variable Entidad
     * usando los valores porporcionados en el array.
     * 
     * @param array $array Datos para rellenar la variable.
     */
    public function rellenar($array)
    {
        // Si la variable $array no es un array o está vacío, no hay nada que hacer.
        if (!is_array($array) || empty($array)) {
            return;
        }

        foreach ($array as $indice => $valor) {
            // Ignormos los campos que están en "noRellenar"
            if (in_array($indice, $this->noRellenar)) {
                continue;
            }

            // Usamos camel case, no hace falta de momento sustituir guiones.
            $metodo = 'set' . ucfirst($indice);

            if (property_exists($this, $indice)) {
                $this->{$indice} = $valor;
            } else if (method_exists($this, $metodo)) {
                $this->$metodo($valor);
            }
        }
    }
}
<?php

require_once(__DIR__ . "/ArraySerializable.php");

abstract class Entidad implements ArraySerializable
{
    protected $id;

    protected $noRellenar = [
        'id'
    ];

    /**
     * Array que contiene los campos / atributos
     * que no se rellenaran mediante la función
     * "to 
     */
    protected $noDevolver = [];

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
    /**
     * Devuelve un array con los valores visibles de este
     * objeto.
     * 
     * @return array
     */
    public function toArray()
    {
        $array = [];
        // Mediante la función "get_object_vars" obtenemos el nombre
        // de todos los atributos de la clase a la que pertenece el objeto.
        // en forma de array. Recorremos este array para obtener un
        // array con los índices equivalentes a los nombres y con los
        // valores que dicho objeto tiene asignados.
        foreach (get_object_vars($this) as $propiedad => $valor) {
            // Si la propiedad está incluida en el array "noDevolver", simplemente continuamos.
            if (in_array($propiedad, $this->noDevolver)) {
                continue;
            }

            // Agregamos el valor usando como índice el nombre de la propiedad / atributo
            $array[$propiedad] = $valor;
        }

        // Devolvemos el array obtenido
        return $array;
    }
}
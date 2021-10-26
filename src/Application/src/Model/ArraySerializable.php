<?php

namespace Dotpak\Hospital\Mvc\Model;

/**
 * Interface que proporciona funcionalidades para 
 * autorrellenar desde un array o convertir en 
 * un array a los objetos de una clase.
 */
interface ArraySerializable
{
    /**
     * Autorellena internamente los campos / atributos
     * usando los valores porporcionados en un array.
     * 
     * @param array $array Datos para rellenar la variable.
     * 
     * @return void
     */
    public function rellenarConArray($array);

    /**
     * Devuelve un array con los valores de los campos /
     * atributos del objeto.
     * 
     * @return array
     */
    public function toArray();
}
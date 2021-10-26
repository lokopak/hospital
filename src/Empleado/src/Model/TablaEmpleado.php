<?php

namespace Dotpak\Hospital\Empleado\Model;

use Dotpak\Hospital\Mvc\Model\Tabla;
use Empleado;

class TablaEmpleado extends Tabla
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();
        // Asitnamos la tabla a la clase.
        $this->nombreTabla = "empleados";
    }

    /**
     * Busca todos los Empleados que se encuentran
     * en la tabla 'empleados' y que cumplen los requisitos
     * establecidos por los parámetros de búsqueda.
     * 
     * @param array $columnas Array con las columnas que se 
     *                        quieren obtener de la tabla.
     *                     OJO: nunca se incluirá la columna userPassword en esta.
     * @return mixed Array de objetos con los distintos empleados encontrados.
     */
    public function buscarTodos($columnas = [])
    {
        // Obtenemos todas las entradas encontradas en la base de datos en forma de arrays.
        $resultado = $this->obtenerTodos($columnas);

        $empleados = [];
        // Convertimos cada entrada en el array recibido en el objeto correspondiente.
        foreach ($resultado as $datos) {
            // Instanciamos el nuevo objeto
            $empleado = new Empleado();
            // Antes de seguir, removemos el userPassword del array, para evitar que se pueda filtrar.
            if (isset($datos['userPassword'])) {
                unset($datos['userPassword']);
            }
            // Rellenamos todos los atributos incluidos en el array en el objeto.
            $empleado->rellenarConArray($datos);

            // Agregamos el nuevo objeto al array
            $empleados[] = $empleado;
        }

        // Devolvemos el array generado con todos los objetos encontrados.
        return $empleados;
    }
}
<?php

require_once(__DIR__ . "/../../model/Tabla.php");
require_once(__DIR__ . "/Empleado.php");
require_once(__DIR__ . "/../../administrador/model/Administrador.php");
require_once(__DIR__ . "/../../celador/model/Celador.php");
require_once(__DIR__ . "/../../nutricionista/model/Nutricionista.php");

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
            // Para facilitar el uso de los objetos, obtenemos el nombre de la clase correspondiente en base a su cargo.
            $clase = $this->obtenerNombreClase($datos);
            // Instanciamos el nuevo objeto
            $empleado = new $clase();
            // Antes de seguir, removemos el userPassword del array, para evitar que se pueda filtrar.
            if (isset($datos['userPassword'])) {
                unset($datos['userPassword']);
            }
            // Rellenamos todos los atributos incluidos en el array en el objeto.
            $empleado->rellenar($datos);

            // Agregamos el nuevo objeto al array
            $empleados[] = $empleado;
        }

        // Devolvemos el array generado con todos los objetos encontrados.
        return $empleados;
    }

    /**
     * 
     */
    public function obtenerNombreClase($datos)
    {
        if (!isset($datos['cargo'])) {
            return 'Empleado';
        }
        switch ($datos['cargo']) {
            case 1:
                return 'Administrador';
            case 2:
                return 'Nutricionista';
            case 3:
                return 'Celador';
            default:
                return 'Empleado';
        }
    }
}
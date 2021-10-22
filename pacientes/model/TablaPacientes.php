<?php

require_once(__DIR__ . "/../../model/Tabla.php");
require_once(__DIR__ . "/Paciente.php");

class TablaPaciente extends Tabla
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();
        // Asitnamos la tabla a la clase.
        $this->nombreTabla = "pacientes";
    }

    /**
     * Busca todos los Empleados que se encuentran
     * en la tabla 'pacientes' y que cumplen los requisitos
     * establecidos por los parámetros de búsqueda.
     * 
     * @param array $columnas Array con las columnas que se 
     *                        quieren obtener de la tabla.
     *                     OJO: nunca se incluirá la columna userPassword en esta.
     * @return mixed Array de objetos con los distintos pacientes encontrados.
     */
    public function buscarTodos($columnas = [])
    {
        // Obtenemos todas las entradas encontradas en la base de datos en forma de arrays.
        $resultado = $this->obtenerTodos($columnas);

        $pacientes = [];
        // Convertimos cada entrada en el array recibido en el objeto correspondiente.
        foreach ($resultado as $datos) {
            // Instanciamos el nuevo objeto
            $paciente = new Paciente();
            // Rellenamos todos los atributos incluidos en el array en el objeto.
            $paciente->rellenarConArray($datos);

            // Agregamos el nuevo objeto al array
            $pacientes[] = $paciente;
        }

        // Devolvemos el array generado con todos los objetos encontrados.
        return $pacientes;
    }
}
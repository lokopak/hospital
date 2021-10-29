<?php

require_once(__DIR__ . "/../../model/Tabla.php");
require_once(__DIR__ . "/../../empleados/model/Empleado.php");
require_once(__DIR__ . "/../../pacientes/model/Paciente.php");
require_once(__DIR__ . "/Informe.php");

class TablaInforme extends Tabla
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();
        // Asitnamos la tabla a la clase.
        $this->nombreTabla = "informes";
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
        // $resultado = $this->obtenerTodos($columnas);
        $query = sprintf('SELECT informes.*,
            empleados.id as idEmpleado, empleados.nombre as nombreEmpleado, empleados.apellidos as apellidosEmpleado,
            pacientes.id as idEPaciente, pacientes.nombre as nombrePaciente, pacientes.apellidos as apellidosPaciente
            FROM %s
            LEFT JOIN empleados ON empleados.id = informes.idCelador
            LEFT JOIN pacientes ON pacientes.id = informes.idPaciente
            ORDER BY id ASC', $this->nombreTabla);

        $resultado = $stmt  = $this->conexion->prepare($query);

        $stmt->execute();

        if (!$resultado) {
            return [];
        }

        $informes = [];
        // Convertimos cada entrada en el array recibido en el objeto correspondiente.
        foreach ($resultado as $datos) {
            // Instanciamos el nuevo objeto
            $informe = new Informe();
            // Rellenamos todos los atributos incluidos en el array en el objeto.
            $informe->rellenarConArray($datos);

            $paciente = new Paciente();
            $paciente->rellenarConArray([
                'id' => $datos['idPaciente'],
                'nombre' => $datos['nombrePaciente'],
                'apellidos' => $datos['apellidosPaciente']
            ]);

            $empleado = new Empleado();
            $empleado->rellenarConArray([
                'id' => $datos['idEmpleado'],
                'nombre' => $datos['nombreEmpleado'],
                'apellidos' => $datos['apellidosEmpleado']
            ]);

            // Agregamos el nuevo objeto al array
            $informes[] = [
                'informe' => $informe,
                'paciente' => $paciente,
                'empleado' => $empleado
            ];
        }
        // Devolvemos el array generado con todos los objetos encontrados.
        return $informes;
    }
}
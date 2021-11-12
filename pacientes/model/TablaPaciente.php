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
        // Llamamos al constructor de la clase Tabla para permitir
        // que el objeto se instacie completamente.
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
     * @return Paginador Array de objetos con los distintos pacientes encontrados.
     */
    public function buscarTodos($columnas = [], $busqueda = [], $paginar = false)
    {
        // Obtenemos todas las entradas encontradas en la base de datos en forma de arrays.
        $resultado = $this->obtenerTodos($columnas, $busqueda, $paginar);

        $pacientes = [];
        // Convertimos cada entrada en el array recibido en el objeto correspondiente.
        foreach ($resultado->getElementos() as $datos) {
            // Instanciamos el nuevo objeto
            $paciente = new Paciente();
            // Rellenamos todos los atributos incluidos en el array en el objeto.
            $paciente->rellenarConArray($datos);

            // Agregamos el nuevo objeto al array
            $pacientes[] = $paciente;
        }

        $resultado->setElementos($pacientes);
        // Devolvemos el array generado con todos los objetos encontrados.
        return $resultado;
    }

    /**
     * Genera una cantidad de pacientes aleatorios para popularizar la base de datos.
     * 
     * @return void
     */
    public function dummyData()
    {
        $min = (new DateTime('1950-01-01'))->getTimestamp();
        $minRegistro = (new DateTime('2021-01-01'))->getTimestamp();
        $ahora = time();

        $letras = 'abcdefghijklmnopqrstuvwxyz';

        $habitaciones = [];
        require_once __DIR__ . "/../../dietas/model/TablaDieta.php";
        $dietas = array_values(TablaDieta::getInstancia()->getDietas());

        $query = 'INSERT INTO pacientes (nombre, apellidos, habitacion, dieta, estado, fechaNacimiento, fechaRegistro, fechaSalida) VALUES ';

        for ($i = 0; $i < 2000; $i++) {
            $nombre = ucfirst(substr(str_shuffle($letras), 0, rand(5, 10)));
            $apellido1 = ucfirst(substr(str_shuffle($letras), 0, rand(5, 10)));
            $apellido2 = ucfirst(substr(str_shuffle($letras), 0, rand(5, 10)));
            $apellidos = sprintf("%s %s", $apellido1, $apellido2);

            $habitacion = 0;
            do {
                $habitacion = rand(1, 2000);
            } while (in_array($habitacion, $habitaciones));
            $habitaciones[] = $habitacion;

            $dieta = $dietas[rand(0, count($dietas) - 1)];
            while ($dieta->tieneHijas()) {
                $d = rand(0, count($dieta->getHijas()) - 1);
                $dieta = array_values($dieta->getHijas())[$d];
            }

            $estado = rand(Paciente::PACIENTE_ESTADO_ALTA, Paciente::PACIENTE_ESTADO_UCI);

            $fechaNacimiento = new DateTime(date('Y-m-d', rand($min, $ahora)));

            $fechaRegistro = new DateTime(date('Y-m-d H:i:s', rand($minRegistro, $ahora)));
            $fecha = (new DateTime(date('Y-m-d H:i:s', $fechaRegistro->getTimestamp() + (60 * 60 * 24 * 30))))->getTimestamp();

            $maxFecha = min($ahora, $fecha);

            $fechaAlta = null;
            if ($estado === Paciente::PACIENTE_ESTADO_ALTA || $estado === Paciente::PACIENTE_ESTADO_FALLECIDO) {
                $fechaAlta = new DateTime(date('Y-m-d H:i:s', rand($fechaRegistro->getTimestamp(), $maxFecha)));
            }

            $query .= sprintf(
                "('%s', '%s', %d, '%s', %d, '%s', '%s', %s ),",
                $nombre,
                $apellidos,
                $habitacion,
                $dieta->getNombre(),
                $estado,
                $fechaNacimiento->format('Y-m-d'),
                $fechaRegistro->format('Y-m-d H:i:s'),
                ($fechaAlta === null) ? 'NULL' : sprintf("'%s'", $fechaAlta->format('Y-m-d H:i:s'))
            );
        }

        // Para evitar agregar un if en cada iteración, simplemente eliminamos la última ',' en la última entrada de datos.
        $query = rtrim($query, ',');

        $this->query($query);
    }
}
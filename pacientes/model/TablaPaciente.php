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

    public function dummyData()
    {
        $min = (new DateTime('1950-01-01'))->getTimestamp();
        $minRegistro = (new DateTime('2021-11-01'))->getTimestamp();
        $ahora = time();

        $letras = 'abcdefghijklmnopqrstuvwxyz';

        $habitaciones = [];
        require_once __DIR__ . "/../../dietas/model/TablaDieta.php";
        $dietas = array_values(TablaDieta::getInstancia()->getDietas());

        for ($i = 0; $i < 1000; $i++) {
            $nombre = substr(str_shuffle($letras), 0, rand(5, 10));
            $apellid1 = substr(str_shuffle($letras), 0, rand(5, 10));
            $apellid2 = substr(str_shuffle($letras), 0, rand(5, 10));

            $habitacion = 0;
            do {
                $habitacion = rand(1, 2000);
            } while (in_array($habitacion, $habitaciones));
            $habitaciones[] = $habitacion;

            $dieta = $dietas[rand(0, count($dietas) - 1)];

            $estado = rand(Paciente::PACIENTE_ESTADO_ALTA, Paciente::PACIENTE_ESTADO_UCI);

            $fechaNacimiento = new DateTime(date('Y-m-d', rand($min, $ahora)));
            $fechaRegistro = new DateTime(date('Y-m-d', rand($minRegistro, $ahora)));

            $this->insertar(
                [
                    'nombre' => ucfirst($nombre),
                    'apellidos' => ucfirst($apellid1) . " " . ucfirst($apellid2),
                    'habitacion' => $habitacion,
                    'dieta' => $dieta->getNombre(),
                    'estado' => $estado,
                    'fechaNacimiento' => $fechaNacimiento->format('Y-m-d'),
                    'fechaRegistro' => $fechaRegistro->format('Y-m-d')
                ]
            );
        }
    }
}
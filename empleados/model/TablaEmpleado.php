<?php

require_once(__DIR__ . "/../../model/Tabla.php");
require_once(__DIR__ . "/Empleado.php");

class TablaEmpleado extends Tabla
{
    /**
     * Constructor.
     * 
     * @throws Exception
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

    /**
     * Devuelve el nombre de la clase que corresponde a
     * un empleado dependiendo de su cargo.
     * 
     * @return string
     */
    public function obtenerNombreClase($datos)
    {
        switch ($datos['cargo']) {
            case Empleado::CARGO_EMPLEADO_ADMINISTRADOR:
                return Administrador::class;
            case Empleado::CARGO_EMPLEADO_NUTRICIONISTA:
                return Nutricionista::class;
            case Empleado::CARGO_EMPLEADO_CELADOR:
                return Celador::class;
            case Empleado::CARGO_EMPLEADO_INACTIVO:
                return "Inactivo";
            default:
                return Empleado::class;
        }
    }

    /**
     * Genera una cantidad de empleados aleatorios para rellenar la base de datos.
     * 
     * @return void
     */
    public function dummyData()
    {
        $min = (new DateTime('1950-01-01'))->getTimestamp();
        $minRegistro = (new DateTime('2021-01-01'))->getTimestamp();
        $ahora = time();

        $letras = 'abcdefghijklmnopqrstuvwxyz';
        $numeros = '0123456789';

        $query = 'INSERT INTO empleados (nombre, apellidos, DNI, cargo, userPassword) VALUES ';

        $nutricionistas = 0;
        $dnis = [];
        for ($i = 0; $i < 40; $i++) {
            $nombre = ucfirst(substr(str_shuffle($letras), 0, rand(5, 10)));
            $apellido1 = ucfirst(substr(str_shuffle($letras), 0, rand(5, 10)));
            $apellido2 = ucfirst(substr(str_shuffle($letras), 0, rand(5, 10)));
            $apellidos = sprintf("%s %s", $apellido1, $apellido2);

            do {
                $dni = sprintf('%s%s', substr(str_shuffle($numeros), 0, 8), strtoupper(substr($letras, rand(0, strlen($letras) - 2), 1)));
            } while (in_array($dni, $dnis));
            $dnis[] = $dni;

            do {
                $cargo = rand(Empleado::CARGO_EMPLEADO_INACTIVO, Empleado::CARGO_EMPLEADO_NUTRICIONISTA);
                if ($cargo === Empleado::CARGO_EMPLEADO_NUTRICIONISTA) {
                    $nutricionistas++;
                }
            } while ($cargo === Empleado::CARGO_EMPLEADO_NUTRICIONISTA && $nutricionistas < 1);

            $query .= sprintf(
                "('%s', '%s', '%s', %d, '%s'),",
                $nombre,
                $apellidos,
                $dni,
                $cargo,
                password_hash('111111', PASSWORD_DEFAULT)
            );
        }

        // Para evitar agregar un if en cada iteración, simplemente eliminamos la última ',' en la última entrada de datos.
        $query = rtrim($query, ',');

        $resultado = $this->query($query);
    }
}
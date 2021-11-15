<?php

declare(strict_types=1);

require_once(__DIR__ . "/../../model/Tabla.php");
require_once(__DIR__ . "/../../empleados/model/Empleado.php");
require_once(__DIR__ . "/../../pacientes/model/Paciente.php");
require_once(__DIR__ . "/Informe.php");
require_once(__DIR__ . "/../../dietas/model/TablaDieta.php");

class TablaInforme extends Tabla
{
    protected $nombreTabla = "informes";

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
    public function buscarTodos($columnas = [], $busqueda = [])
    {
        try {
            // Obtenemos todas las entradas encontradas en la base de datos en forma de arrays.
            // $resultado = $this->obtenerTodos($columnas);
            $query = sprintf('SELECT informes.*,
                empleados.id as idEmpleado, empleados.nombre as nombreEmpleado, empleados.apellidos as apellidosEmpleado,
                pacientes.id as idPaciente, pacientes.nombre as nombrePaciente, pacientes.apellidos as apellidosPaciente
                FROM %s
                INNER JOIN empleados ON empleados.id = informes.idEmpleado
                INNER JOIN pacientes ON pacientes.id = informes.idPaciente', $this->nombreTabla);

            if (isset($busqueda['idPaciente'])) {
                $query .= sprintf(' WHERE informes.idPaciente = %d', (int) $busqueda['idPaciente']);

                if (isset($busqueda['idEmpleado'])) {
                    $query .= sprintf(' AND informes.idEmpleado = %d', (int) $busqueda['idEmpleado']);
                }
            } else if (isset($busqueda['idEmpleado'])) {
                $query .= sprintf(' WHERE informes.idEmpleado = %d', (int) $busqueda['idEmpleado']);
            }

            // Asignamos valor por defecto a la columna
            if (!isset($busqueda['ordenPor'])) {
                $busqueda['ordenPor'] = 'id';
            }
            // es necesario para constriuir una query correcta.
            if (strcmp($busqueda['ordenPor'], 'paciente') === 0 || strcmp($busqueda['ordenPor'], 'empleado') === 0) {
                // ej: 'paciente' -> 'informes.idPaciente'
                $busqueda['ordenPor'] = $busqueda['ordenPor'] . 's.apellidos';
            }

            // Asignamos valor por defecto a la columna
            if (!isset($busqueda['orden'])) {
                $busqueda['orden'] = 'ASC';
            }

            $query .= sprintf(' ORDER BY %s %s', $busqueda['ordenPor'], $busqueda['orden']);

            $stmt  = $this->conexion->prepare($query);

            $stmt->execute();

            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Anulamos la declaración para poder cerrar correctamente la conexión al final de la ejecución de la app.
            $stmt = null;

            if (!$resultado) {
                return [];
            }

            $informes = [];
            // Convertimos cada entrada en el array recibido en el objeto correspondiente.
            foreach ($resultado as $datos) {
                // Instanciamos el nuevo objeto
                $informe = new Informe();
                // Rellenamos todos los atributos incluidos en el array en el objeto.

                // Convertimos los datos del paciente en un objeto
                $paciente = new Paciente();
                $paciente->rellenarConArray([
                    'id' => $datos['idPaciente'],
                    'nombre' => $datos['nombrePaciente'],
                    'apellidos' => $datos['apellidosPaciente']
                ]);
                // Agregamos el objeto del paciente al array de datos.
                $datos['paciente'] = $paciente;

                // Convertimos los datos del empleado en un objeto 
                $empleado = new Empleado();
                $empleado->rellenarConArray([
                    'id' => $datos['idEmpleado'],
                    'nombre' => $datos['nombreEmpleado'],
                    'apellidos' => $datos['apellidosEmpleado']
                ]);
                // Agregamos el objeto del empleado en el array de datos.
                $datos['empleado'] = $empleado;

                // Convertimos el nombre de la dieta en el objeto correspondiente y se lo agregamos al array de datos.
                $datos['dieta'] = TablaDieta::getInstancia()->getDietaPorNombre($datos['dieta']);

                // Convertimos la fecha en un objeto DateTime y se lo agregamos al array de datos.
                $datos['fecha'] = new DateTime($datos['fecha']);

                // Ahora sí, rellenamos el objeto del informe con los datos recibidos.
                $informe->rellenarConArray($datos);

                // Agregamos el nuevo objeto al array
                $informes[] = $informe;
            }

            return $informes;
        } catch (PDOException $e) {
            require_once(__DIR__ . "/../../services/AppError.php");
            return AppError::error('Error en la base de datos', 'No se ha podido llevar a cabo la petición indicada.', $e);
        }
    }

    /**
     * Búsca un elemento en la tabla correspondiente que coincida
     * con la id proporcionada. Y devuele un array con los índices
     * coincidentes con las columnas de la tabla.
     * 
     * @param int $id Id a buscar.
     * 
     * @return mixed
     */
    public function buscarUno($id, $busqueda = null, $columnas = [])
    {
        try {
            // Montamos la query pasándole el string de las columnas y el nombre de la tabla.
            $query = sprintf('SELECT informes.*,
                                empleados.id as idEmpleado, empleados.nombre as nombreEmpleado, empleados.apellidos as apellidosEmpleado,
                                pacientes.id as idPaciente, pacientes.nombre as nombrePaciente, pacientes.apellidos as apellidosPaciente
                                FROM %s
                                INNER JOIN pacientes ON pacientes.id = informes.idPaciente
                                INNER JOIN empleados ON empleados.id = informes.idEmpleado
                                WHERE informes.id = %d', $this->nombreTabla, $id);

            // Preparamos la declaración
            $stmt  = $this->conexion->prepare($query);
            // Y ejecutamos la query.
            $stmt->execute();

            // Recogemos todas las filas encontradas en forma de array asociativo.
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            // Anulamos la declaración para poder cerrar correctamente la conexión al final de la ejecución de la app.
            $stmt = null;

            if (!$resultado) {
                return null;
            }

            // Instanciamos el nuevo objeto
            $informe = new Informe();
            // Rellenamos todos los atributos incluidos en el array en el objeto.

            // Convertimos los datos del paciente en un objeto
            $paciente = new Paciente();
            $paciente->rellenarConArray([
                'id' => $resultado['idPaciente'],
                'nombre' => $resultado['nombrePaciente'],
                'apellidos' => $resultado['apellidosPaciente']
            ]);
            // Agregamos el objeto del paciente al array de datos.
            $resultado['paciente'] = $paciente;

            // Convertimos los datos del empleado en un objeto 
            $empleado = new Empleado();
            $empleado->rellenarConArray([
                'id' => $resultado['idEmpleado'],
                'nombre' => $resultado['nombreEmpleado'],
                'apellidos' => $resultado['apellidosEmpleado']
            ]);
            // Agregamos el objeto del empleado en el array de datos.
            $resultado['empleado'] = $empleado;

            // Convertimos el nombre de la dieta en el objeto correspondiente y se lo agregamos al array de datos.
            $resultado['dieta'] = TablaDieta::getInstancia()->getDietaPorNombre($resultado['dieta']);

            // Convertimos la fecha de modificación en un objeto DateTime y se lo agregamos al array de datos.
            if (!empty($resultado['fechaModificacion'])) {
                // Convertimos la fecha en un objeto DateTime y se lo agregamos al array de datos.
                $resultado['fechaModificacion'] = new DateTime($resultado['fechaModificacion']);
            }

            // Convertimos la fecha en un objeto DateTime y se lo agregamos al array de datos.
            $resultado['fecha'] = new DateTime($resultado['fecha']);

            // Ahora sí, rellenamos el objeto del informe con los datos recibidos.
            $informe->rellenarConArray($resultado);

            if (!empty($resultado['ultimoEditor'])) {
                $query = sprintf('SELECT empleados.id, empleados.nombre, empleados.apellidos FROM empleados WHERE empleados.id = %d', (int) $resultado['ultimoEditor']);

                // Preparamos la declaración
                $stmt  = $this->conexion->prepare($query);
                // Y ejecutamos la query.
                $stmt->execute();

                // Recogemos todas las filas encontradas en forma de array asociativo.
                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

                // Anulamos la declaración para poder cerrar correctamente la conexión al final de la ejecución de la app.
                $stmt = null;

                if (null !== $resultado) {
                    $ultimoEditor = new Empleado();
                    $ultimoEditor->rellenarConArray($resultado);
                    $informe->setUltimoEditor($ultimoEditor);
                }
            }

            // Devolvemos el informe encontrado
            return $informe;
        } catch (PDOException $e) {
            require_once(__DIR__ . "/../../services/AppError.php");
            return AppError::error('Error en la base de datos', 'No se ha podido llevar a cabo la petición indicada.', $e);
        }
    }

    /**
     * Genera una cantidad de informes aleatorios para rellenar la base de datos.
     * 
     * @return void
     */
    public function dummyData()
    {
        require_once __DIR__ . "/../../dietas/model/TablaDieta.php";

        $celadores = $this->query(sprintf('SELECT id FROM empleados WHERE cargo = %d', Empleado::CARGO_EMPLEADO_CELADOR));

        $pacientes = $this->query('SELECT * FROM pacientes');
        $ahora = time();
        // for ($i = 0; $i < 4000; $i++) {
        foreach ($pacientes as $paciente) {

            $query = 'INSERT INTO `informes` (`idPaciente`, `idEmpleado`, `dieta`, `fecha`, `desayuno`, `comida1`, `comida2`, `comida3`, `merienda`, `cena1`, `cena2`, `cena3`, `fechaModificacion`, `ultimoEditor`) VALUES ';

            $minFecha = (new DateTime($paciente['fechaRegistro']));
            $maxFecha = empty($paciente['fechaSalida']) ? new DateTime('now') : new DateTime($paciente['fechaSalida']);

            $dias = $maxFecha->diff($minFecha)->days;
            for ($i = 0; $i < $dias; $i++) {
                $fecha = new DateTime(date('Y-m-d H:i:s', $minFecha->getTimestamp() + (60 * 60 * 24 * $i)));
                $celador = $celadores[rand(0, count($celadores) - 1)]['id'];

                $dieta = $paciente['dieta'];

                $desayuno = rand(1, 5);
                $comida1 = rand(1, 5);
                $comida2 = rand(1, 5);
                $comida3 = rand(1, 5);
                $merienda = rand(1, 5);
                $cena1 = rand(1, 5);
                $cena2 = rand(1, 5);
                $cena3 = rand(1, 5);


                $query .= sprintf(
                    "(%d, %d, '%s', '%s', %d, %d, %d, %d, %d, %d, %d, %d, NULL, NULL),",
                    $paciente['id'],
                    $celador,
                    $dieta,
                    $fecha->format('Y-m-d H:i:s'),
                    $desayuno,
                    $comida1,
                    $comida2,
                    $comida3,
                    $merienda,
                    $cena1,
                    $cena2,
                    $cena3,
                );
            }

            // Para evitar agregar un if en cada iteración, simplemente eliminamos la última ',' en la última entrada de datos.
            $query = rtrim($query, ',');
            // print_r($query);
            $this->query($query);
        }
    }
}
<?php

require_once(__DIR__ . "/ConexionDB.php");

abstract class Tabla
{

    /**
     * Conexión con la base de datos
     * 
     * @var \ConexionDB
     */
    protected $conexion;

    /**
     * Nombre de la tabla asociada a la clase correspondiente.
     * 
     * @var string
     */
    protected $nombreTabla;

    /**
     * Constructor.
     * 
     * @throws Exception.
     */
    public function __construct()
    {
        // Creamos la conexión con la base de datos para no tener que manejarnos con ella más.
        $this->conexion = ConexionDB::getConexion();

        if ($this->conexion instanceof AppError) {
            throw new Exception("No se ha podido establecer la conexión con la base de datos.");
        }
    }

    /**
     * Obtiene todas las entradas encontradas en la tabla y que
     * cumplan los requisitos proporcionados para la búsqueda.
     * 
     * @param array $columnas [opcional] Las columnas que se van a querer obtener desde la tabla.
     * @param array $busqueda [opcional] Parámetros de búsqueda
     * @param bool $paginar [opcinonal] Indica si el resultado debe ser entregado por páginas o no.
     * 
     * @return Paginador|null Un array con todos las entradas encontradas en forma de array.
     *                  O null en caso de fallo en la consulta.
     * 
     * @throws Exception
     */
    public function obtenerTodos($columnas = [], $busqueda = [])
    {
        // Todas las interacciones con la base de datos através de PDO deben ir en un bloque try/catch para recoger las
        // posibles excepciones que estás lancen y evitar mostar datos que podrían poner en peligro la integridad
        // de la base de datos.
        try {
            // Comprobamos si se ha recibido valores para las columnas
            if (empty($columnas)) {
                // En caso de no haberse recibido o de recibir un array vacío, obtenemos todas las columnas
                $cols = '*';
            } else {
                // En caso contrario convertimos el array en un string con todos los valores separados por comas.
                $cols = implode(',', $columnas);
            }

            // Montamos la query pasándole el string de las columnas y el nombre de la tabla.
            $query = sprintf('SELECT %s FROM %s', $cols, $this->nombreTabla);

            if (isset($busqueda['where'])) {
                $where = '';
                foreach ($busqueda['where'] as $indice => $valor) {
                    if (!empty($where)) {
                        $where .= ' OR ';
                    }
                    switch($indice) {
                        case 'nombre': $where .= "nombre LIKE '%$valor%'"; break;
                        case 'apellidos':
                            $where .= "apellidos LIKE '%$valor%'";
                            break;
                    }
                }

                $where = ' WHERE ' . $where;

                $query .= $where;
            }

            // Asignamos valor por defecto a la columna
            if (!isset($busqueda['ordenPor'])) {
                $busqueda['ordenPor'] = 'id';
            }
            // Asignamos valor por defecto a la columna
            if (!isset($busqueda['orden'])) {
                $busqueda['orden'] = 'ASC';
            }

            $query .= sprintf(' ORDER BY %s %s', $busqueda['ordenPor'], $busqueda['orden']);

            // Preparamos la declaración
            $stmt  = $this->conexion->prepare($query);
            // Y ejecutamos la query.
            $stmt->execute();

            // Recogemos todas las filas encontradas en forma de array asociativo.
            $resultado = $stmt->fetchAll();
            // Anulamos la declaración para poder cerrar correctamente la conexión al final de la ejecución de la app.
            $stmt = null;

            return $resultado;
        } catch (Exception $e) {
            require_once(__DIR__ . "/../services/AppError.php");
            return AppError::error('Error en la base de datos', 'No se ha podido llevar a cabo la petición indicada.', $e);
        }

        return null;
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
    // public abstract function buscarTodos($columnas = [], $busqueda = []);

    /**
     * Inserta los datos proporcionados en la tabla correspondiente.
     * 
     * @param array $datos.
     */
    public function insertar($datos)
    {
        try {
            // Recopilamos todas los índices del array en un string con la forma: "columna1,columna2,columna3...."
            $columnas = implode(',', array_keys($datos));
            // Creamos un string relleno de '?', uno por cada valor incluido en el array, con la forma "?,?,?..." que nos servirá de placeholders para incluir los valores en la query.
            $valores = implode(',', array_fill(0, count($datos), '?'));

            // Construimos la query incluyendo el string de las columnas y el de los placeholders donde irán los valores.
            $query = sprintf("INSERT INTO %s (%s) VALUES (%s)", $this->nombreTabla, $columnas, $valores);

            // Terminamos de preparar la query
            $stmt = $this->conexion->prepare($query);

            // Ejecutamos la query pasando un array que contiene únicamente los valores que se insertarán en los placeholders.
            $stmt->execute(array_values($datos));
            // Anulamos la declaración para poder cerrar correctamente la conexión al final de la ejecución de la app.
            $stmt = null;

            // Recogemos y devolvemos la id asignada al elemento recien insertado.
            return $this->conexion->lastInsertId();
        } catch (PDOException $e) {
            require_once(__DIR__ . "/../services/AppError.php");
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
            // Comprobamos si se ha recibido valores para las columnas
            if (empty($columnas)) {
                // En caso de no haberse recibido o de recibir un array vacío, obtenemos todas las columnas
                $cols = '*';
            } else {
                // En caso contrario convertimos el array en un string con todos los valores separados por comas.
                $cols = implode(',', $columnas);
            }

            // Comprobamos si se ha recibido valores para las columnas
            if (is_null($busqueda)) {
                // En caso de no haberse recibido o de recibir un array vacío, obtenemos todas las columnas
                $busqueda = 'id';
            }

            // Montamos la query pasándole el string de las columnas y el nombre de la tabla.
            $query = sprintf('SELECT %s FROM %s WHERE %s = ?', $cols, $this->nombreTabla, $busqueda);

            // Preparamos la declaración
            $stmt  = $this->conexion->prepare($query);
            // Y ejecutamos la query.
            $stmt->execute([$id]);

            // Recogemos todas las filas encontradas en forma de array asociativo.
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            // Anulamos la declaración para poder cerrar correctamente la conexión al final de la ejecución de la app.
            $stmt = null;

            // Devolvemos el resultado
            return $resultado;
        } catch (PDOException $e) {
            require_once(__DIR__ . "/../services/AppError.php");
            return AppError::error('Error en la base de datos', 'No se ha podido llevar a cabo la petición indicada.', $e);
        }
    }

    /**
     * Actualiza los datos de un elemento en la tabla correspondiente.
     * 
     * @param array $datos
     * 
     * @return boolean
     */
    public function actualizar($id, $datos)
    {
        try {
            // Construimos la query incluyendo el string de las columnas y el de los placeholders donde irán los valores.
            $query = sprintf("UPDATE %s SET ", $this->nombreTabla);

            // Recorremos los campos indicados en el array de datos para generar cada columna y poder asignar valores.
            $i = 0;
            foreach ($datos as $indice => $valor) {
                // Vamos a ignorar aquí la id por seguridad.
                if ($indice === 'id') {
                    $i++; // No la contamos, pero hay que tenerla en cuenta.
                    continue;
                }
                // Aquí de momento sólo nos hace falta el índice
                $query .= sprintf("%s = ?", $indice);
                // Si no es el último, agregamos una coma
                if ($i < (count($datos) - 1)) {
                    $query .= ', ';
                }
                $i++;
            }
            // Importante agregar el término where para no liarla pardísima.
            $query .= sprintf(" WHERE id = %d", $id);

            // Terminamos de preparar la query
            $stmt = $this->conexion->prepare($query);

            // Ejecutamos la query pasando un array que contiene únicamente los valores que se insertarán en los placeholders.
            $resultado = $stmt->execute(array_values($datos));
            // Anulamos la declaración para poder cerrar correctamente la conexión al final de la ejecución de la app.
            $stmt = null;

            return $resultado;
        } catch (PDOException $e) {
            require_once(__DIR__ . "/../services/AppError.php");
            return AppError::error('Error en la base de datos', 'No se ha podido llevar a cabo la petición indicada.', $e);
        }
    }

    /**
     * Ejecuta una query proporcionado.
     * 
     * @param string $query La query a ejecutar.
     * 
     * @return mixed
     */
    public function query($query)
    {
        try {

            // Terminamos de preparar la query
            $stmt = $this->conexion->prepare($query);

            // Ejecutamos la query pasando un array que contiene únicamente los valores que se insertarán en los placeholders.
            $resultado = $stmt->execute();

            if (strpos($query, 'SELECT') !== false) {
                $resultado = $stmt->fetchAll();
            }
            // Anulamos la declaración para poder cerrar correctamente la conexión al final de la ejecución de la app.
            $stmt = null;

            return $resultado;
        } catch (PDOException $e) {
            require_once(__DIR__ . "/../services/AppError.php");
            return AppError::error('Error en la base de datos', 'No se ha podido llevar a cabo la petición indicada.', $e);
        }
    }
}
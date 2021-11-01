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
     */
    public function __construct()
    {
        // Creamos la conexión con la base de datos para no tener que manejarnos con ella más.
        $this->conexion = ConexionDB::getConexion();
    }

    /**
     * Obtiene todas las entradas encontradas en la tabla y que
     * cumplan los requisitos proporcionados para la búsqueda.
     * 
     * @param array $columnas [opcional] Las columnas que se van a querer obtener desde la tabla.
     * 
     * @return array|null Un array con todos las entradas encontradas en forma de array.
     *                  O null en caso de fallo en la consulta.
     * 
     * @throws Exception
     */
    public function obtenerTodos($columnas = [])
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
            $query = sprintf('SELECT %s FROM %s ORDER BY id ASC', $cols, $this->nombreTabla);

            // Preparamos la declaración
            $stmt  = $this->conexion->prepare($query);
            // Y ejecutamos la query.
            $stmt->execute();

            // Recogemos todas las filas encontradas en forma de array asociativo.
            $resultado = $stmt->fetchAll();
            // Anulamos la declaración para poder cerrar correctamente la conexión al final de la ejecución de la app.
            $stmt = null;

            // Devolvemos el resultado
            return $resultado;
        } catch (Exception $e) {
            require_once(__DIR__ . "/../../services/AppError.php");
            return AppError::error('Error en la base de datos', 'No se ha podido llevar a cabo la petición indicada.', $e);
        }

        return null;
    }

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
    public function buscarUno($id)
    {
        try {
            // Montamos la query pasándole el string de las columnas y el nombre de la tabla.
            $query = sprintf('SELECT * FROM %s WHERE id = ?', $this->nombreTabla);

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

    public function actualizar($datos)
    {
    }
}
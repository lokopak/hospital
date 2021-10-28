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
            // Excepción
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
        $columnas = implode(',', array_keys($datos));
        $valores = implode(',', array_fill(0, count($datos), '?'));
        $query = sprintf("INSERT INTO %s (%s) VALUES (%s)", $this->nombreTabla, $columnas, $valores);
        $stmt = $this->conexion->prepare($query);
        $stmt->execute(array_values($datos));
        $stmt = null;

        return $this->conexion->lastInsertId();;
    }
    public function buscarUno($id){
        
            // Montamos la query pasándole el string de las columnas y el nombre de la tabla.
            $query = sprintf('SELECT * FROM %s WHERE id = %d', $this->nombreTabla, $id);

            // Preparamos la declaración
            $stmt  = $this->conexion->prepare($query);
            // Y ejecutamos la query.
            $stmt->execute();

            // Recogemos todas las filas encontradas en forma de array asociativo.
            $resultado = $stmt-> fetch(PDO::FETCH_ASSOC);
            // Anulamos la declaración para poder cerrar correctamente la conexión al final de la ejecución de la app.
            $stmt = null;

            // Devolvemos el resultado
            return $resultado;
        

        return null;

    }
}
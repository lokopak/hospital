<?php

class ConexionDB extends PDO
{

    /**
     * Atributo de clase donde guardaremos el único objeto
     * que puede crearse de la clase ConexionDB.
     * Lo declaramos static para que pertenezca a la clase
     * en sí y poder acceder a él sin necesidad de instanciar
     * un objeto.
     * 
     * @var \ConexionDB
     */
    protected static $instancia;

    /**
     * Constructor
     * Lo declaramos privado para que sólo puedan crearse
     * objetos de la clase ConexionDB desde dentro de la
     * propia clase.
     * 
     * @param string $dsn El dsn de la conexión de la base de datos.
     * @param string $userName El nombre de usuario de la base de datos.
     * @param string $pass El password de la base de datos.
     * @param array $options Array con las opciones para la conexión.
     */
    private function __construct($dsn, $userName, $pass, $options = [])
    {
        // Para que se cree correctamente el objeto y abra la conexión debemos llamar al constructor de la clase padre.
        parent::__construct($dsn, $userName, $pass, $options);
    }

    /**
     * Devuelve el único objeto de la clase ConexionDB
     * que puede existir. En caso de no haberse instanciado
     * lo hace abriendo la conexión directamente.
     * 
     * @return \ConexionDB
     */
    public static function getConexion()
    {
        // Si no se ha instanciado ya...
        if (!self::$instancia) {
            // Instanciamos el objeto y lo guardamos en el atributo correspondiente.
            self::$instancia = self::crearConexion();
        }

        return self::$instancia;
    }

    /**
     * Instancia el único objeto de la clase ConexionDB
     * al mismo tiempo que abre la conexión con la base de datos.
     * 
     * @return \ConexionDB
     * 
     * @throws \Exception
     */
    private static function crearConexion()
    {
        $datos = require_once(__DIR__ . "/../config/local.php");

        if (!isset($datos['basedatos'])) {
            throw new Exception("No se ha proporcionado una configuración correcta para la conexión con la base de datos");
        }

        $host = $datos['basedatos']['host'] ?? '';
        if (isset($datos['basedatos']['dbname'])) {
            $dbname = $datos['basedatos']['dbname'];
        } else {
            $dbname = '';
        }
        $userName = $datos['basedatos']['usuario'] ?? '';
        $pass = $datos['basedatos']['password'] ?? '';
        $driver = $datos['basedatos']['driver'] ?? '';

        $dsn = sprintf("%s:host=%s;dbname=%s", $driver, $host, $dbname);

        try {
            return new ConexionDB($dsn, $userName, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
        } catch (PDOException $e) {
            require_once(__DIR__ . "/../services/AppError.php");

            return new AppError("ERROR:", "It seems that the jawas have passed through here and taken some important parts from this site, please try again later, maybe we could have fixed it.");
        }
    }
}
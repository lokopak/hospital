<?php

class ConexionDB
{

    protected static $instancia;

    protected $conexion;

    private function __construct()
    {
    }

    public static function getConexion()
    {
        if (!self::$instancia) {
            self::$instancia = self::crearConexion();
        }

        return self::$instancia;
    }

    private static function crearConexion() 
    {
        $datos = require_once(__DIR__ . "/../config/local.php");

        $host = $datos['basedatos']['host'] ?? '';
        if (isset($datos['basedatos']['dbname'])) {
            $dbname = $datos['basedatos']['dbname'];
        }
        else {
            $dbname = '';
        }
        $userName = $datos['basedatos']['usuario'] ?? '';
        $pass = $datos['basedatos']['password'] ?? '';

        $dsn = sprintf("mysql:host=%s;dbname=%s", $host, $dbname);
        
        try{
            $instancia = new ConexionDB();
            $instancia->conexion = new PDO($dsn, $userName, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $instancia;
        } catch(PDOException $e){
            die("ERROR: Could not connect. " . $e->getMessage());
        }
    }
}

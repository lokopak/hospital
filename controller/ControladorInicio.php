<?php

require_once __DIR__ . "/Controlador.php";
require_once(__DIR__ . "/../login/services/Autorizacion.php");
require_once __DIR__ . "/../pacientes/model/TablaPaciente.php";
require_once(__DIR__ . "/../model/ConexionDB.php");

/**
 * Controlador para la página principal.
 */
class ControladorInicio extends Controlador
{
    /**
     * Acción por defecto del controlador.
     * 
     * @return \View
     */
    public function index()
    {

        if (!Autorizacion::getInstancia()->tieneIdentidad()) {
            header("location: /login/login.php");
            exit();
        }

        $hoy = new DateTime(date('Y-m-d H:i:s', time() + (60 * 60 * 24 * -7)));
        $conexion = ConexionDB::getConexion();
        $seleccion = sprintf("SELECT id FROM pacientes WHERE estado > 1 AND DATE(fechaRegistro) >= '%s'", $hoy->format("Y-m-d H:i:s"));
        $consulta = $conexion->query($seleccion);
        $numeroPacientes = $consulta->rowCount();

        $seleccion = sprintf("SELECT id FROM pacientes WHERE estado = 0 AND DATE(fechaRegistro) >= '%s'", $hoy->format("Y-m-d H:i:s"));
        $consulta = $conexion->query($seleccion);
        $numeroAltaPacientes = $consulta->rowCount();

        $seleccion = sprintf("SELECT id FROM pacientes WHERE estado = 1 AND DATE(fechaRegistro) >= '%s'", $hoy->format("Y-m-d H:i:s"));
        $consulta = $conexion->query($seleccion);
        $numeroDefunciones = $consulta->rowCount();

        $seleccion = "SELECT id FROM informes";
        $seleccion = sprintf("SELECT id FROM informes WHERE DATE(fecha) >= '%s'", $hoy->format("Y-m-d H:i:s"));
        $consulta = $conexion->query($seleccion);
        $numeroInformes = $consulta->rowCount();

        $this->setPlantilla('ejemplos');

        return $this->mostrarHtml([
            'numeroInformes' => $numeroInformes,
            'numeroDefunciones' => $numeroDefunciones,
            'numeroAltaPacientes' => $numeroAltaPacientes,
            'numeroPacientes' => $numeroPacientes
        ]);
    }
}
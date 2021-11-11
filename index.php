<?php

require_once(__DIR__ . "/login/services/Autorizacion.php");

if (!Autorizacion::getInstancia()->tieneIdentidad()) {
    header("location: /login/login.php");
}


require_once __DIR__ . "/pacientes/model/TablaPaciente.php";

$tabla = new TablaPaciente();

require_once(__DIR__ . "/model/ConexionDB.php");
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

// $resultado = $tabla->query("SELECT COUNT(id) FROM pacientes WHERE estado > 1");



$contenido = __DIR__ . "/view/ejemplos.php";

require_once(__DIR__ . "/view/pagina.phtml");
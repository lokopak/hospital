<?php

require_once(__DIR__ . "/login/services/Autorizacion.php");

if (!Autorizacion::getInstancia()->tieneIdentidad()) {
    header("location: /login/login.php");
}
require_once(__DIR__ . "/model/ConexionDB.php");
$conexion = ConexionDB::getConexion();
$seleccion = "SELECT id FROM pacientes WHERE estado>1";
$consulta = $conexion->query($seleccion);
$numeroPacientes=$consulta->rowCount();

$seleccion = "SELECT id FROM pacientes WHERE estado=0";
$consulta = $conexion->query($seleccion);
$numeroAltaPacientes = $consulta->rowCount();

$seleccion = "SELECT id FROM pacientes WHERE estado=1";
$consulta = $conexion->query($seleccion);
$numeroDefunciones = $consulta->rowCount();

$seleccion = "SELECT id FROM informes";
$consulta = $conexion->query($seleccion);
$numeroInformes = $consulta->rowCount();
   

$contenido = __DIR__ . "/view/ejemplos.php";

require_once(__DIR__ . "/view/pagina.phtml");
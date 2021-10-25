<?php
require_once(__DIR__ . "/model/Empleado.php");

if ($_POST) {
    //Agregamos....
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $DNI = $_POST['DNI'];
    $cargo = $_POST['cargo'];
    $insert =  "INSERT INTO empleados (nombre, apellidos, DNI, cargo) values (" . $nombre . "," . $apellidos . "," . $DNI. "," . $cargo.")";
    echo $insert
    mysqli_query($conexion, $insert);
    // redirigimos  
}


$cargos = Empleado::getCargosDisponibles();

$contenido = __DIR__ . "/view/altaEmpleados.php";

return require_once(__DIR__ . "/../view/pagina.phtml");

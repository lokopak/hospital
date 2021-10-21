<?php
require_once(__DIR__ . "/model/TablaEmpleado.php");

// Creamos la interface con la talba empleados
$conexion = new TablaEmpleado();

// Realizamos la consulta para buscar el listado de empleados pasándole sólo las columnas que queremos/necesitamos mostrar.
$empleados = $conexion->buscarTodos(['id', 'nombre', 'apellidos', 'DNI', 'cargo']);

// Guardamos el path al archivo que tiene el contenido de la página
$contenido = __DIR__ . "/view/index.phtml";

// Y mostramos la página entera.
return require(__DIR__ . "/../view/pagina.phtml");
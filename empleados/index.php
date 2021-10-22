<?php
require_once(__DIR__ . "/model/TablaEmpleado.php");

/**
 * Este archivo funciona como controlador de la página de inicio de empleados.
 */

// Creamos la interface con la tabla empleados
$conexion = new TablaEmpleado();

// Realizamos la consulta para buscar el listado de empleados pasándole sólo las columnas que queremos/necesitamos mostrar.
$empleados = $conexion->buscarTodos(['id', 'nombre', 'apellidos', 'DNI', 'cargo']);

// Guardamos el path al archivo que tiene el contenido de la página.
// NOTA: como la llamada / require al archivo con la plantilla de la página se hace desde aquí, guardamos el path en relación a este archivo.
$contenido = __DIR__ . "/view/index.phtml";

// Y mostramos la página entera.
return require(__DIR__ . "/../view/pagina.phtml");
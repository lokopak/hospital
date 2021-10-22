<?php
require_once(__DIR__ . "/model/TablaInforme.php");

/**
 * Este archivo funciona como controlador de la página de inicio de informes.
 */

// Creamos la interface con la tabla informes
$conexion = new TablaInforme();

// Realizamos la consulta para buscar el listado de informes pasándole sólo las columnas que queremos/necesitamos mostrar.
$informes = $conexion->buscarTodos(['id', 'idNutricionista', 'idPaciente', 'idCelador', 'dieta', 'fecha', 'desayuno', 'comida1', 'comida2', 'comida3', 'merienda', 'cena1', 'cena2', 'cena3', 'fechaModificacion', 'ultimoEditor']);

// Guardamos el path al archivo que tiene el contenido de la página.
// NOTA: como la llamada / require al archivo con la plantilla de la página se hace desde aquí, guardamos el path en relación a este archivo.
$contenido = __DIR__ . "/view/index.phtml";

// Y mostramos la página entera.
return require(__DIR__ . "/../view/pagina.phtml");

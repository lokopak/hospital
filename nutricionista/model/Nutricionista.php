<?php

require_once(__DIR__ . "/../../empleados/model/Empleado.php");

/**
 * La clase Nutricionista contiene todas las características
 * y acciones propias de un nutricionista. Aunque en principio
 * esta clase no tiene relación directa con alguna de las tablas
 * de la base de datos, sirve de encapsulamiento para separarlo
 * de los demás empleados. Cualquier empleado con el atributo
 * 'cargo' igual a Empleado::CARGO_EMPLEADO_NUTRICIONISTA
 * será automáticamente convertido a esta clase cuando 
 * se recojan los datos de la tabla 'empleados'.
 */
class Nutricionista extends Empleado
{
}
<?php

require_once(__DIR__ . "/../../empleados/model/Empleado.php");

/**
 * La clase Celador contiene todas las características
 * y acciones propias de un celador. Aunque en principio
 * esta clase no tiene relación directa con alguna de las tablas
 * de la base de datos, sirve de encapsulamiento para separarlo
 * de los demás empleados. Cualquier empleado con el atributo
 * 'cargo' igual a Empleado::CARGO_EMPLEADO_CELADOR
 * será automáticamente convertido a esta clase cuando 
 * se recojan los datos de la tabla 'empleados'.
 */
class Celador extends Empleado
{
}
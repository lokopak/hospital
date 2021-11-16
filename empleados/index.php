<?php

require_once __DIR__ . "/controller/ControladorEmpleado.php";

$contolador = new ControladorEmpleado();

return $contolador->index();
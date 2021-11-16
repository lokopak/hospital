<?php
require_once __DIR__ . "/controller/ControladorPaciente.php";

$contolador = new ControladorPaciente();

return $contolador->index();

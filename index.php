<?php

require_once __DIR__ . '/controller/ControladorInicio.php';


$controlador = new ControladorInicio();

return $controlador->index();
<?php

require_once(__DIR__ . "/model/TablaDieta.php");
$tablaDieta = new TablaDieta();

$dietas = $tablaDieta->getDietas();

$contenido = __DIR__ . "/view/index.phtml";

return require_once(__DIR__ . "/../view/pagina.phtml");
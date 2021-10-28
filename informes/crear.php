<?php

require_once(__DIR__ . "/../services/Peticion.php");
require_once(__DIR__ . "/model/TablaInforme.php");

if (Peticion::esPost()) {
    $datos = Peticion::obtenerPost();

    print_r(["datos" => $datos]);
}

$contenido = __DIR__ . "/view/crear.phtml";

require_once(__DIR__ . "/../view/pagina.phtml");
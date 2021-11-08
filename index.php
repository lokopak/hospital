<?php

require_once(__DIR__ . "/login/services/Autorizacion.php");

if (!Autorizacion::getInstancia()->tieneIdentidad()) {
    header("location: /login/login.php");
}

$contenido = __DIR__ . "/view/ejemplos.php";

require_once(__DIR__ . "/view/pagina.phtml");
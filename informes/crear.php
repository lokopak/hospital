<?php

require_once(__DIR__ . "/model/TablaInforme.php");

if ($_POST) {
    $desayuno = $_POST['desayuno'];

    $tablaInformes = new TablaInforme();

    $tablaInformes->insertar(["desayuno" => $desayuno]);
}

$contenido = __DIR__ . "/view/crear.php";

return require_once(__DIR__ . "/../view/pagina.phtml");
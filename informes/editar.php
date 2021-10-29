<?php

require_once(__DIR__ . "/../services/Peticion.php");
require_once(__DIR__ . "/model/TablaInforme.php");
require_once(__DIR__ . "/model/Informe.php");

if (Peticion::getInstancia()->esPost()) {

    // Recogemos todos los datos desde el POST
    $datos = Peticion::getInstancia()->fromPost();

    // Convertimos todos los valores a su tipo correcto.
    foreach ($datos as $indice => $dato) {
        // La fecha debe permanecer de momento como string
        if (strpos('fecha', $indice) !== false) {
            continue;
        }
        // El resto de valores debe ser un integer.
        $datos[$indice] = (int) $dato;
    }

    // Fecha de la última edición.
    $datos['fechaModificacion'] = (new DateTime())->format('Y/m/d H:i:s');
    // Aquí recogeríamos la id del empleado que está realizando la edición desde la sessión.
    $datos['ultimoEditor'] = 1;

    $tablaInformes = new TablaInforme();

    $idInforme = $tablaInformes->actualizar($datos);

    if ($idInforme > 0) {
        echo '
        <div class="alert alert-success" role="alert">
          Informe editado correctamente.
        </div>';
    } else {
        echo '
        <div class="alert alert-warning" role="alert">
          Algo ha fallado.
        </div>';
    }
} else {
}

$contenido = __DIR__ . "/view/crear.phtml";

require_once(__DIR__ . "/../view/pagina.phtml");
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


    $informe = new Informe();
    $informe->rellenarConArray($datos);
    // $informe->setFecha(time());
    // $informe->setIdCelador(1);
    // $informe->setIdPaciente(1);

    $datos['idCelador'] = 1;
    $datos['idPaciente'] = 1;
    $datos['fecha'] = (new DateTime())->format('Y/m/d H:i:s');

    $tablaInformes = new TablaInforme();

    $idInforme = $tablaInformes->insertar($datos);

    if ($idInforme > 0) {
        header("Location: /informes/editar.php?idInforme=" . $idInforme);
    } else {
        echo '
        <div class="alert alert-warning" role="alert">
          Algo ha fallado.
        </div>';
    }
}

$contenido = __DIR__ . "/view/crear.phtml";

require_once(__DIR__ . "/../view/pagina.phtml");
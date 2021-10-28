<?php

require_once(__DIR__ . "/../services/Peticion.php");
require_once(__DIR__ . "/model/TablaPaciente.php");
require_once(__DIR__ . "/model/Paciente.php");

if (Peticion::getInstancia()->esPost()) {

    // Recogemos todos los datos desde el POST
    $datos = Peticion::getInstancia()->fromPost();

    // Convertimos todos los valores a su tipo correcto.
    
        // El resto de valores debe ser un integer.
        $datos['estado'] = (int) $datos['estado'];
    



    $tablaPacientes = new TablaPaciente();

    $idPaciente = $tablaPacientes->insertar($datos);

    if ($idPaciente > 0) {
        header("Location: /pacientes/crear.php?idPaciente=" . $idPaciente);
    } else {
        echo '
        <div class="alert alert-warning" role="alert">
          Algo ha fallado.
        </div>';
    }
}

$contenido = __DIR__ . "/view/crear.php";

require_once(__DIR__ . "/../view/pagina.phtml");

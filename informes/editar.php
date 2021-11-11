<?php

require_once(__DIR__ . "/../login/services/Autorizacion.php");
require_once(__DIR__ . "/../login/services/ControlAcceso.php");

if (!Autorizacion::getInstancia()->tieneIdentidad()) {
    header("location: /login/login.php");
}
if (!(ControlAcceso::tieneAcceso('INFORMES@VER') || ControlAcceso::tieneAcceso('INFORMES@VER_PROPIOS'))) {
    header("location: /login/no-autorizado.php");
}

require_once(__DIR__ . "/../services/Peticion.php");
require_once(__DIR__ . "/model/TablaInforme.php");
require_once(__DIR__ . "/model/Informe.php");
require_once(__DIR__ . "/../services/AppError.php");

$tablaInformes = new TablaInforme();

if (Peticion::getInstancia()->esPost()) {

    // Recogemos todos los datos desde el POST
    $datos = Peticion::getInstancia()->fromPost();

    if (empty($datos)) {
        return AppError::error("Petición incorrecta", "La petición solicitada es incorrecta.");
    }

    if (!isset($datos['idInforme'])) {
        return AppError::error("No encontrado", "El informe no se ha encontrado.");
    }

    // Nos aseguramos de que el informe existe.
    $informe = $tablaInformes->buscarUno($datos['idInforme']);
    if (null === $informe) {
        return AppError::error("No encontrado", "El informe no se ha encontrado.");
    }

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
    $datos['ultimoEditor'] = Autentificacion::getInstancia()->usuarioActual()->getId();

    // Recogemos la id en un variable a parte para manejarla por separado.
    $id = (int) $datos['idInforme'];
    // Eliminamos esta entrada en el array, ya no nos sirve.
    unset($datos['idInforme']);

    $resultado = $tablaInformes->actualizar($id, $datos);

    if ($resultado > 0) {
        echo '
        <div class="alert alert-success" role="alert">
          Informe editado correctamente.
        </div>';
        // No es muy elegante, pero es la forma más segura de recoger los datos.
        $informe = $tablaInformes->buscarUno($id);
    } else {
        return (new AppError("No encontrado", "El informe no se ha encontrado.", null, AppError::ERROR_NO_ENCONTRADO))->mostrarError();
    }
} else {
    $idInforme = Peticion::getInstancia()->fromGet('idInforme');
    if (null === $idInforme) {
        return (new AppError("No encontrado", "El informe no se ha encontrado.", null, AppError::ERROR_NO_ENCONTRADO))->mostrarError();
    }

    $informe = $tablaInformes->buscarUno((int) $idInforme);

    if ($informe instanceof AppError) {
        return $resultado->mostrarError();
    }

    if (!$informe) {
        return (new AppError("No encontrado", "El informe no se ha encontrado.", null, AppError::ERROR_NO_ENCONTRADO))->mostrarError();
    }
}

$contenido = __DIR__ . "/view/editar.phtml";

require_once(__DIR__ . "/../view/pagina.phtml");
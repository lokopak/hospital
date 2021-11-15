<?php

require_once(__DIR__ . "/../login/services/Autorizacion.php");

if (!Autorizacion::getInstancia()->tieneIdentidad()) {
    header("location: /login/login.php");
}

require_once(__DIR__ . "/../login/services/ControlAcceso.php");
if (!ControlAcceso::tieneAcceso('INFORMES@CREAR')) {
    header("location: /login/no-autorizado.php");
}

require_once(__DIR__ . "/../services/Peticion.php");
require_once(__DIR__ . "/../services/message/Messenger.php");
require_once(__DIR__ . "/model/TablaInforme.php");
require_once(__DIR__ . "/model/Informe.php");
require_once(__DIR__ . "/../services/AppError.php");
require_once(__DIR__ . "/../pacientes/model/TablaPaciente.php");
require_once(__DIR__ . "/../empleados/model/TablaEmpleado.php");
require_once(__DIR__ . "/../pacientes/model/Paciente.php");


// Comprobamos si el usuraio ha enviado el form.
if (Peticion::getInstancia()->esPost()) {

    // Recogemos todos los datos desde el POST
    $datos = Peticion::getInstancia()->fromPost();

    // Convertimos todos los valores a su tipo correcto.
    foreach ($datos as $indice => $dato) {
        // La fecha debe permanecer de momento como string
        if (strpos('fecha', $indice) !== false || strpos('dieta', $indice) !== false) {
            continue;
        }

        if (empty($dato)) {
            unset($datos[$indice]);
        } else {
            // El resto de valores debe ser un integer.
            $datos[$indice] = (int) $dato;
        }
    }

    // Si no se ha proporcionado la idPaciente o la idInforme, mostramos el error y no continuamos.
    if (!isset($datos['idPaciente'])) {
        return (new AppError('Petición no válida', 'No se ha proporcionado los datos necesarios'))->mostrarError();
    }

    // Recogemos la id del paciente en una variable aislada.
    $idPaciente = $datos['idPaciente'];

    // Y nos aseguramos de que el paciente con esa id existe.
    $datosPaciente = (new TablaPaciente())->buscarUno($idPaciente);

    // Si se ha producido un error durante la inserción, simplemente mostramos el error.
    if ($datosPaciente instanceof AppError) {
        return $datosPaciente->mostrarError();
    }

    if (null === $datosPaciente) {
        return (new AppError('No encontrado', 'No se ha encontrado el elemento buscado.', AppError::ERROR_NO_ENCONTRADO))->mostrarError();
    }

    $paciente = new Paciente();
    $paciente->rellenarConArray($datosPaciente);
    unset($datosPaciente);

    // Recogemos la id del empleado desde la sesión.
    $datos['idEmpleado'] = Autentificacion::getInstancia()->usuarioActual()->getId();

    // Por si acaso, aseguramos que la fecha correcta es la de hoy.
    $datos['fecha'] = (new DateTime('NOW'))->format("Y/m/d H:i:s");

    // Establecemos la conexión con la base de datos y la tabla correspondiente.
    $tablaInformes = new TablaInforme();

    // Insertamos el nuevo informe en la base de datos y recogemos el resultado.
    $idInforme = $tablaInformes->insertar($datos);

    // Si se ha producido un error durante la inserción, simplemente mostramos el error.
    if ($idInforme instanceof AppError) {
        return $idInforme->mostrarError();
    }

    // Si todo ha ido bien, redirigimos a la página correspondiente para editar el informe.
    if ($idInforme > 0) {
        Messenger::getInstance()->agregarMensaje('Informe creado correctamente', 'success');
        header("Location: /informes/editar.php?idInforme=" . $idInforme);
        exit();
    } else {
        Messenger::getInstance()->agregarMensaje('No se ha podido agregar el informe', 'danger');
    }
}
// En caso contraio, simplemente mostramos el form para que sea rellenado.
else {
    //Nos aseguramos de que se proporciona la id del paciente
    $idPaciente = Peticion::getInstancia()->fromGet('idPaciente');

    // Si no se ha proporcionado la idPaciente, mostramos el error y no continuamos.
    if (null === $idPaciente) {
        return (new AppError('Petición no válida', 'No se ha proporcionado los datos necesarios'))->mostrarError();
    }

    // Y nos aseguramos de que el paciente con esa id existe.
    $datosPaciente = (new TablaPaciente())->buscarUno($idPaciente);

    // Si se ha producido un error durante la inserción, simplemente mostramos el error.
    if ($datosPaciente instanceof AppError) {
        return $datosPaciente->mostrarError();
    }

    if (null === $datosPaciente) {
        return (new AppError('No encontrado', 'No se ha encontrado el elemento buscado.', AppError::ERROR_NO_ENCONTRADO))->mostrarError();
    }

    if (isset($datosPaciente['dieta'])) {
        $dieta = TablaDieta::getInstancia()->getDietaPorNombre($datosPaciente['dieta']);
        $datosPaciente['dieta'] = $dieta;
    }

    $paciente = new Paciente();
    $paciente->rellenarConArray($datosPaciente);
}

$contenido = __DIR__ . "/view/crear.phtml";

require_once(__DIR__ . "/../view/pagina.phtml");
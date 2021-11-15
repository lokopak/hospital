<?php

require_once __DIR__ . "/../../controller/Controlador.php";
require_once(__DIR__ . "/../../login/services/Autorizacion.php");
require_once(__DIR__ . "/../../login/services/ControlAcceso.php");
require_once(__DIR__ . "/../../login/services/Autentificacion.php");

require_once(__DIR__ . "/../model/TablaInforme.php");
require_once(__DIR__ . "/../../pacientes/model/TablaPaciente.php");
require_once(__DIR__ . "/../../services/AppError.php");
require_once(__DIR__ . "/../../services/Peticion.php");
require_once(__DIR__ . "/../../services/Sesion.php");
require_once(__DIR__ . "/../../services/paginador/Paginador.php");
require_once __DIR__ . "/../../services/message/Messenger.php";

class ControladorInforme extends Controlador
{

    /**
     * Muestra la página con el listado de dietas
     */
    public function index()
    {

        // Sesion::getInstancia()->sesionIniciada();

        if (!Autorizacion::getInstancia()->tieneIdentidad()) {
            header("location: /login/login.php");
            exit();
        }

        if (!(ControlAcceso::tieneAcceso('INFORMES@VER') || ControlAcceso::tieneAcceso('INFORMES@VER_PROPIOS'))) {
            header("location: /login/no-autorizado.php");
            exit();
        }

        $empleado = Autentificacion::getInstancia()->usuarioActual();

        /**
         * Este archivo funciona como controlador de la página de inicio de informes.
         */

        // Creamos la interface con la tabla informes
        $conexion = new TablaInforme();

        $idPaciente = Peticion::getInstancia()->fromGet('idPaciente');

        // Si se ha proporcionado id del paciente, nos aseguramos que se trata con el tipo de variable correcto.
        if (null !== $idPaciente) {
            $busqueda['idPaciente'] = (int) $idPaciente;
        }

        $pagina = Peticion::getInstancia()->fromGet('pagina');
        if (null === $pagina) {
            $pagina = 1;
        }

        $limite = Peticion::getInstancia()->fromGet('limite');
        if (null === $limite) {
            $limite = 20;
        }

        $ordenPor = Peticion::getInstancia()->fromGet('ordenPor');
        if (null === $ordenPor) {
            $ordenPor = 'id';
        }

        $orden = Peticion::getInstancia()->fromGet('orden');
        if (null === $orden) {
            $orden = 'ASC';
        }

        $busqueda = ['ordenPor' => $ordenPor, 'orden' => $orden];
        // Si no puede ver todos los informes, sólo mostramos los que son creados por el empleado
        if (!ControlAcceso::tieneAcceso('INFORMES@VER')) {
            $busqueda['idEmpleado'] = $empleado->getId();
        }

        // Realizamos la consulta para buscar el listado de informes pasándole sólo las columnas que queremos/necesitamos mostrar.
        $resultado = $conexion->buscarTodos([], $busqueda);

        if ($resultado instanceof AppError) {
            return $resultado->mostrarError();
        }

        $resultado = new Paginador($resultado, $pagina, $limite);

        $this->setPlantilla("index");

        return $this->mostrarHtml([
            'busqueda' => $busqueda,
            'resultado' => $resultado,
            'idPaciente' => $idPaciente
        ]);
    }

    public function crear()
    {

        if (!Autorizacion::getInstancia()->tieneIdentidad()) {
            header("location: /login/login.php");
            exit();
        }

        if (!ControlAcceso::tieneAcceso('INFORMES@CREAR')) {
            header("location: /login/no-autorizado.php");
            exit();
        }


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

        $this->setPlantilla("crear");

        return $this->mostrarHtml([
            'paciente' => $paciente,
        ]);
    }

    /**
     * Muestra la página de edición de informes
     * 
     */
    public function editar()
    {

        if (!Autorizacion::getInstancia()->tieneIdentidad()) {
            header("location: /login/login.php");
            exit();
        }
        if (!(ControlAcceso::tieneAcceso('INFORMES@VER') || ControlAcceso::tieneAcceso('INFORMES@VER_PROPIOS'))) {
            header("location: /login/no-autorizado.php");
            exit();
        }

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
                Messenger::getInstance()->agregarMensaje('Informe editado correctamente.', 'success');
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
                return $informe->mostrarError();
            }

            if (!$informe) {
                return (new AppError("No encontrado", "El informe no se ha encontrado.", null, AppError::ERROR_NO_ENCONTRADO))->mostrarError();
            }
        }

        $this->setPlantilla("editar");

        return $this->mostrarHtml([
            'informe' => $informe,
        ]);
    }
}
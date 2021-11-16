<?php
require_once __DIR__ . "/../../controller/Controlador.php";
require_once(__DIR__ . "/../../services/Peticion.php");
require_once(__DIR__ . "/../model/TablaPaciente.php");
require_once(__DIR__ . "/../model/Paciente.php");
require_once(__DIR__ . "/../../login/services/ControlAcceso.php");
require_once(__DIR__ . "/../../login/services/Autorizacion.php");
require_once(__DIR__ . "/../../services/AppError.php");
require_once __DIR__ . "/../../services/paginador/Paginador.php";


class ControladorPaciente extends Controlador
{
    public function crear()
    {
        if (!Autorizacion::getInstancia()->tieneIdentidad()) {
            header("location: /login/login.php");
            exit();
        }

        if (!(ControlAcceso::tieneAcceso('PACIENTES@EDITAR'))) {
            header("location: /login/no-autorizado.php");
            exit();
        }

        if (Peticion::getInstancia()->esPost()) {

            // Recogemos todos los datos desde el POST
            $datos = Peticion::getInstancia()->fromPost();

            // Convertimos todos los valores a su tipo correcto.

            // El resto de valores debe ser un integer.
            $datos['estado'] = (int) $datos['estado'];


            $id = (int) $datos['idPaciente'];

            $datos['id'] = $id;
            unset($datos['idPaciente']);

            $tablaPacientes = new TablaPaciente();

            $idPaciente = $tablaPacientes->insertar($datos);

            // Si se ha producido un error durante la inserción, simplemente mostramos el error.
            if ($idPaciente instanceof AppError) {
                return $idPaciente->mostrarError();
            }

            if ($idPaciente > 0) {
                header("Location: /pacientes/editar.php?idPaciente=" . $idPaciente);
                exit();
            } else {
                echo '
        <div class="alert alert-warning" role="alert">
          Algo ha fallado.
        </div>';
            }
        }
        require_once(__DIR__ . "/../model/Paciente.php");
        $estados = Paciente::getEstados();


        $contenido = __DIR__ . "/../view/crear.phtml";

        require_once(__DIR__ . "/../../view/pagina.phtml");
    }
    public function editar()
    {

        if (!Autorizacion::getInstancia()->tieneIdentidad()) {
            header("location: /login/login.php");
            exit();
        }
        if (!(ControlAcceso::tieneAcceso('PACIENTES@EDITAR'))) {
            header("location: /login/no-autorizado.php");
            exit();
        }

        $tablaPacientes = new TablaPaciente();

        if (Peticion::getInstancia()->esPost()) {

            // Recogemos todos los datos desde el POST
            $datos = Peticion::getInstancia()->fromPost();

            // Convertimos todos los valores a su tipo correcto.

            // El resto de valores debe ser un integer.
            $datos['estado'] = (int) $datos['estado'];

            // Si no se ha proporcionado una ide de paciente, la petición no puede procesarse correctamente. Mostramos un error.
            if (!isset($datos['idPaciente'])) {
                return (new AppError('Petición invalida', 'La petición no incluye los datos necesarios para ser procesada.'))->mostrarError();
            }

            // Recogemos la id del paciente en una variable separada y nos aseguramos que es del tipo correcto.
            $idPaciente = (int) $datos['idPaciente'];
            // Eliminamos esta entrada de los datos, no va a usarse.
            unset($datos['idPaciente']);

            // Comprobamos si el paciente existe
            $paciente = $tablaPacientes->buscarUno($idPaciente);

            // Mostramos el error 'no encontrado'
            if (null === $paciente) {
                return (new AppError('No encontrado', 'No se ha encontrado el elemento indicado.', AppError::ERROR_NO_ENCONTRADO))->mostrarError();
            }

            if ($datos['estado'] != $paciente['estado']) {
                print_r("estado cambiado");
            }

            $resultado = $tablaPacientes->actualizar($idPaciente, $datos);

            // Si se ha recibido un error desde la tabla, lo mostramos.
            if ($resultado instanceof AppError) {
                return $resultado->mostrarError();
            }

            if ($resultado > 0) {
                header("Location: /pacientes/editar.php?idPaciente=" . $idPaciente);
                exit();
            } else {
                echo '
        <div class="alert alert-warning" role="alert">
          Algo ha fallado.
        </div>';
            }
        }
        require_once(__DIR__ . "/../model/Paciente.php");
        $estados = Paciente::getEstados();


        $idPaciente = Peticion::getInstancia()->fromGet('idPaciente');
        if ($idPaciente == null) {
            echo "error";
        }
        $datosPaciente = $tablaPacientes->buscarUno($idPaciente);
        if ($datosPaciente == null) {
            echo "error";
        } else {
            $paciente = new Paciente();
            $paciente->rellenarConArray($datosPaciente);
        }
        $contenido = __DIR__ . "/../view/editar.phtml";

        require_once(__DIR__ . "/../../view/pagina.phtml");
    }
    public function index()
    {

        if (!Autorizacion::getInstancia()->tieneIdentidad()) {
            header("location: /login/login.php");
            exit();
        }


        if (!(ControlAcceso::tieneAcceso('INFORMES@VER') || ControlAcceso::tieneAcceso('INFORMES@VER_PROPIOS'))) {
            header("location: /login/no-autorizado.php");
            exit();
        }

        /**
         * Este archivo funciona como controlador de la página de inicio de pacientes.
         */

        // Creamos la interface con la tabla pacientes
        $conexion = new TablaPaciente();

        $pagina = Peticion::getInstancia()->fromGet('pagina');
        if (
            null === $pagina
        ) {
            $pagina = 1;
        }
        $limite = Peticion::getInstancia()->fromGet('limite');
        if (
            null === $limite
        ) {
            $limite = 20;
        }
        $ordenPor = Peticion::getInstancia()->fromGet('ordenPor');
        if (
            null === $ordenPor
        ) {
            $ordenPor = 'id';
        }
        $orden = Peticion::getInstancia()->fromGet('orden');
        if (null === $orden) {
            $orden = 'ASC';
        }
        $busqueda = ['limite' => $limite, 'pagina' => $pagina, 'ordenPor' => $ordenPor, 'orden' => $orden];


        // Realizamos la consulta para buscar el listado de pacientes pasándole sólo las columnas que queremos/necesitamos mostrar.
        $pacientes = $conexion->buscarTodos(['id', 'nombre', 'apellidos', 'habitacion', 'dieta', 'estado', 'fechaRegistro', 'fechaSalida', 'fechaNacimiento'], $busqueda);

        $pacientes = new Paginador($pacientes, $pagina, $limite);

        // Guardamos el path al archivo que tiene el contenido de la página.
        // NOTA: como la llamada / require al archivo con la plantilla de la página se hace desde aquí, guardamos el path en relación a este archivo.
        $contenido = __DIR__ . "/../view/index.phtml";

        return require(__DIR__ . "/../../view/pagina.phtml");
    }
}

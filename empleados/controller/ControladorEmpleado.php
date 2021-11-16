<?php

require_once __DIR__ . "/../../controller/Controlador.php";

require_once(__DIR__ . "/../../login/services/Autorizacion.php");
require_once(__DIR__ . "/../../login/services/ControlAcceso.php");
require_once __DIR__ . "/../../services/Peticion.php";
require_once __DIR__ . "/../../services/paginador/Paginador.php";
require_once(__DIR__ . "/../model/TablaEmpleado.php");
require_once __DIR__ . "/../../services/AppError.php";
require_once(__DIR__ . "/../model/Empleado.php");

class ControladorEmpleado extends Controlador
{

    public function index()
    {

        if (!Autorizacion::getInstancia()->tieneIdentidad()) {
            header("location: /login/login.php");
            exit();
        }
        if (!(ControlAcceso::tieneAcceso('EMPLEADOS@VER'))) {
            header("location: /login/no-autorizado.php");
            exit();
        }

        /**
         * Este archivo funciona como controlador de la página de inicio de empleados.
         */

        // Creamos la interface con la tabla empleados
        $conexion = new TablaEmpleado();

        // Realizamos la consulta para buscar el listado de empleados pasándole sólo las columnas que queremos/necesitamos mostrar.
        $elementos = $conexion->buscarTodos(['id', 'nombre', 'apellidos', 'DNI', 'cargo']);

        // Si se ha producido algún error durante la conexión con la base de datos, mostramos la página de error.
        if ($elementos instanceof AppError) {
            return $elementos->mostrarError();
        }

        $pagina = Peticion::getInstancia()->fromGet('pagina');
        if (is_null($pagina)) {
            $pagina = 1;
        }
        $ordenPor = Peticion::getInstancia()->fromGet('ordenPor');
        if (
            null === $ordenPor
        ) {
            $ordenPor = 'id';
        }

        $limite = Peticion::getInstancia()->fromGet('limite');
        if (is_null($limite)) {
            $limite = 20;
        }

        $elementos = new Paginador($elementos, $pagina, $limite);
        $orden = Peticion::getInstancia()->fromGet('orden');
        if (null === $orden) {
            $orden = 'ASC';
        }
        $busqueda = ['limite' => $limite, 'pagina' => $pagina, 'ordenPor' => $ordenPor, 'orden' => $orden];

        // Guardamos el path al archivo que tiene el contenido de la página.
        // NOTA: como la llamada / require al archivo con la plantilla de la página se hace desde aquí, guardamos el path en relación a este archivo.
        $empleados = $conexion->buscarTodos(['id', 'nombre', 'apellidos', 'DNI', 'cargo'], $busqueda);

        if ($empleados instanceof AppError) {
            return $empleados->mostrarError();
        }

        $elementos = new Paginador($empleados, $pagina, $limite);

        $this->setPlantilla("index");

        return $this->mostrarHtml([
            'busqueda' => $busqueda,
            'elementos' => $elementos
        ]);
    }

    public function editar()
    {

        if (!Autorizacion::getInstancia()->tieneIdentidad()) {
            header("location: /login/login.php");
            exit();
        }
        if (!(ControlAcceso::tieneAcceso('EMPLEADOS@EDITAR'))) {
            header("location: /login/no-autorizado.php");
            exit();
        }
        $tablaEmpelados = new TablaEmpleado();

        if (Peticion::getInstancia()->esPost()) {

            // Recogemos todos los datos desde el POST
            $datos = Peticion::getInstancia()->fromPost();


            // El resto de valores debe ser un integer.
            $datos['cargo'] = (int) $datos['cargo'];
            // No se ha proporcionado la id del epleado.
            if (!isset($datos['idEmpleado'])) {
                return (new AppError('Petición no válida', 'No se ha proporcionado los datos necesarios'))->mostrarError();
            }

            $idEmpleado = (int) $datos['idEmpleado'];
            unset($datos['idEmpleado']);

            if (isset($datos['cargo'])) {
                // El resto de valores debe ser un integer.
                $datos['cargo'] = (int) $datos['cargo'];
            }
            $resultado = $tablaEmpelados->actualizar($idEmpleado, $datos);

            if ($resultado instanceof AppError) {
                $resultado->mostrarError();
            }
            if ($idEmpleado == null) {
                echo " ERROR";
            }
            $datosEmpleado = $tablaEmpelados->buscarUno($idEmpleado);
            if ($datosEmpleado == null) {
                echo " ERROR";
            } else {
                $empleado = new Empleado();
                $empleado->rellenarConArray($datosEmpleado);
            }

            if ($resultado) {
            } else {
                echo '
                <div class="alert alert-warning" role="alert">
                  Algo ha fallado.
                </div>';
            }
        } else {
            $idEmpleado = Peticion::getInstancia()->fromGet("idEmpleado");
            if ($idEmpleado == null) {
                echo " ERROR";
            }
            $datosEmpleado = $tablaEmpelados->buscarUno($idEmpleado);
            if ($datosEmpleado == null) {
                echo " ERROR";
            } else {
                $empleado = new Empleado();
                $empleado->rellenarConArray($datosEmpleado);
            }
        }

        $this->setPlantilla("editar");

        return $this->mostrarHtml([
            'empleado' => $empleado,
        ]);
    }
}
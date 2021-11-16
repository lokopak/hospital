<?php
require_once __DIR__ . "/../../controller/Controlador.php";
require_once(__DIR__ . "/../../model/Tabla.php");
require_once(__DIR__ . "/../../services/Peticion.php");
require_once(__DIR__ . "/../../empleados/model/TablaEmpleado.php");
require_once(__DIR__ . "/../../pacientes/model/TablaPaciente.php");
require_once(__DIR__ . "/../../services/AppError.php");
require_once __DIR__ . "/../../services/paginador/Paginador.php";


class ControladorBuscar extends Controlador
{

    public function buscar()
    {
        if (Peticion::getInstancia()->esPost()) {
            // Recoger del post el dato a bucar

            $seccion = Peticion::getInstancia()->fromPost('seccion');
            $valor = Peticion::getInstancia()->fromPost('valor');

            if (null === $seccion || empty($seccion)) {
                return (new AppError('Petición invalida', 'La petición no incluye los datos necesarios para ser procesada.'))->mostrarError();
            }

            if ($seccion === 'pacientes') {
                $tabla = new TablaPaciente();
                $colunmnas = ['id', 'nombre', 'apellidos', 'habitacion', 'dieta', 'estado', 'fechaRegistro', 'fechaSalida', 'fechaNacimiento'];

                $elementos = $tabla->buscarTodos($colunmnas, ['where' => ['nombre' => $valor, 'apellidos' => $valor]]);
            } elseif ($seccion === 'empleados') {
                $tabla = new TablaEmpleado();
                $colunmnas = ['id', 'nombre', 'apellidos', 'DNI', 'cargo'];

                $elementos = $tabla->buscarTodos($colunmnas, ['where' => ['nombre' => $valor, 'apellidos' => $valor]]);
            } else {
                return (new AppError('Petición no válida', 'Selecciona Paciente o Empleado para poder continuar'))->mostrarError();
            }


            if ($elementos instanceof AppError) {
                return $elementos->mostrarError();
            }

            if ($seccion === 'pacientes') {
                $pacientes = new Paginador($elementos, 1, 20);
                $contenido = __DIR__ . "/../../pacientes/view/index.phtml";
            } elseif ($seccion === 'empleados') {
                $elementos = new Paginador($elementos, 1, 20);
                $contenido = __DIR__ . "/../../empleados/view/index.phtml";
            } else {
            }

            return require __DIR__ . "/../../view/pagina.phtml";
        }
    }
}
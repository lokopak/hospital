<?php
require_once(__DIR__ . "/../model/Tabla.php");
require_once(__DIR__ . "/../services/Peticion.php");
require_once(__DIR__ . "/../empleados/model/TablaEmpleado.php");
require_once(__DIR__. "/../services/AppError.php");
if (Peticion::getInstancia()->esPost()) {
    // Recoger del post el dato a bucar

    $tabla = new TablaEmpleado();

    $seccion = Peticion::getInstancia()->fromPost('seccion');
    $valor = Peticion::getInstancia()->fromPost('valor');

    if (null === $seccion || empty($seccion)) {
        return (new AppError('Petición invalida', 'La petición no incluye los datos necesarios para ser procesada.'))->mostrarError();
    }

    $query = sprintf("SELECT * FROM %s ", $seccion);
    if (null !== $valor) {        
        $query .= sprintf(' WHERE nombre = \'%1$s\' OR apellidos = \'%1$s\'', $valor);
    }

    $elementos = $tabla->query($query);

    if ($elementos instanceof AppError) {
        return $elementos->mostrarError();
    }

}

if ($seccion === 'pacientes'){
    $elementos = __DIR__ . "/../pacientes/view/index.phtml";
}
elseif ($seccion === 'empleados'){
    $elementos = __DIR__. "/../empleados/view/index.phtml";
}



return require(__DIR__ . "/../view/pagina.phtml");





        



<?php
require_once(__DIR__ . "/../../model/Tabla.php");
if (Peticion::getInstancia()->esPost()) {
    // Recoger del post el dato a bucar

    $tablaGeneral = new Tabla();

    $datos = Peticion::getInstancia()->fromPost();

    if (!isset($datos['id'])) {
        return (new AppError('Petición invalida', 'La petición no incluye los datos necesarios para ser procesada.'))->mostrarError();
    }

    $id = (int) $datos['id'];
    unset($datos['id']);
    
    
    $query = sprintf("SELECT * FROM %s WHERE nombre = %s OR apellidos = %s", $datos['seccion'], $datos['valor'], $datos['valor']);

    $resultado = $tabla->query($query);

    if (null === $id) {
        return (new AppError('No encontrado', 'No se ha encontrado el elemento indicado.', AppError::ERROR_NO_ENCONTRADO))->mostrarError();
    }
}

// Crear objeto Buscador con el dato recogido


// Llamar a función de busqueda para recoger datos

// Mostrar datos con html





        



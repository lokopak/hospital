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
    } else {
        echo '
        <div class="alert alert-warning" role="alert">
          Algo ha fallado.
        </div>';
    }
}
require_once(__DIR__ . "/model/Paciente.php");
$estados = Paciente::getEstados();


/**
 * Imprime una fila de la tabla con una dieta sin dietas hijas.
 * 
 * @param Dieta $dieta Dieta a imprimir
 * @param int $cols [opcional] número de columnas a ocupar.
 */
function imprimirDietaSinHijas($dieta, $cols = 3)
{
    echo '<tr>
    <td colspan="' . $cols . '">' . $dieta->getDescripcion() . '</td>
    <td class="border-start border-end bg-warning"><input class="form-check-input" type="radio" value="' . $dieta->getMadre() . '" id="dieta" name="dieta"> <label class="form-check-label" for="flexCheckDefault"></label></td>
            
    </tr>';
}

/**
 * Calcula el número de filas que debe ocupar una celda de la tabla
 * dependiendo del número de hijas que tiene la dieta.
 * 
 * @param Dieta $dieta Dieta a imprimir
 */
function getRowspan($dieta)
{
    $rows = 1;
    if (!empty($dieta->getHijas())) {
        $rows = count($dieta->getHijas());

        foreach ($dieta->getHijas() as $hija) {
            if (!empty($hija->getHijas())) {
                $rows += count($hija->getHijas()) - 1;
            }
        }
    }


    return $rows;
}

/**
 * Calcula el número de columnas que debe ocupar una celda de la tabla
 * dependiendo de si tiene hijas o no.
 * 
 * @param Dieta $dieta Dieta a imprimir
 * @param int $max El número máximo de columnas que puede ocupar.
 * @param int $min El número mínimo de columnas que debe ocupar.
 */
function getColspan($dieta, $max, $min)
{
    if (empty($dieta->getHijas())) {
        return $max;
    }

    return $min;
}


/**
 * Imprime una fila de la tabla con una dieta con dietas hijas.
 * 
 * @param Dieta $dieta Dieta a imprimir
 * @param int $paso [opcional] El paso a seguir dentro de cada dieta.
 *          @paso 0: Imprime la dieta y todas las primeras hijas / nietas (primera fila)
 *          @paso 1: Imprime todas las hijas restantes de la dieta madre. Entre cada iteración del paso 1, se intercala el paso 2.
 *          @paso 2: Imprime todas las dietas nietas restantes.
 * @param int $indice [opcional] Ídice de la dieta dentro del array de hijas.
 */
function imprimirDietaConHijas($dieta, $paso = 0, $indice = 0)
{
    if ($paso === 0) {
        $result = '<tr>';
        $result .= '<td class="border-end" rowspan="' . getRowspan($dieta) . '" colspan="' . getColspan($dieta, 3, 1) . '"> ' . $dieta->getNombre() . '</td>';
        if (!empty(($hijas = $dieta->getHijas()))) {
            $hija = $hijas[0];
            $result .= '<td rowspan="' . getRowspan($hija) . '" colspan="' . getColspan($hija, 2, 1) . '">' . $hija->getDescripcion() . '</td>';
            if (!empty(($nietas = $hija->getHijas()))) {
                $nieta = $nietas[0];
                $result .= '<td class="border-start">' . $nieta->getDescripcion()  . '</td>';
                $result .= '<td class="border-start border-end bg-warning"><input class="form-check-input" type="radio" value="' . $nieta->getMadre() . '" id="dieta" name="dieta"> <label class="form-check-label" for="flexCheckDefault"></label></td>';
            } else {
                $result .= '<td class="border-start border-end bg-warning"><input class="form-check-input" type="radio" value="' . $hija->getMadre() . '" id="dieta" name="dieta"> <label class="form-check-label" for="flexCheckDefault"></label></td>';
            }

            $result .= '</tr>';
            echo $result;

            for ($j = 1; $j < count($nietas); $j++) {
                imprimirDietaConHijas($nietas[$j], 2, $j);
            }
            imprimirDietaConHijas($dieta, 1);
        } else {
            $result .= '</tr>';
            echo $result;
        }
    } else if ($paso === 1) {
        $hijas = $dieta->getHijas();
        for ($i = 1; $i < count($hijas); $i++) {
            $result = '<tr>';
            $result .= '<td class="" rowspan="' . getRowspan($hijas[$i]) . '" colspan="' . getColspan($hijas[$i], 2, 1) . '">' . $hijas[$i]->getDescripcion()  . '<span class="text-muted fst-italic ms-3">(id: ' . $hijas[$i]->getMadre() . ')</span></td>';
            if (!empty(($nietas = $hijas[$i]->getHijas()))) {
                $nieta = $nietas[0];
                $result .= '<td class="border-start">' . $nieta->getDescripcion()  . '</td>';
                $result .= '<td class="border-start boder-end bg-warning"><input class="form-check-input" type="radio" value="' . $nieta->getMadre() . '" id="dieta" name="dieta"> <label class="form-check-label" for="flexCheckDefault"></label></td>';
                $result .= '</tr>';
                echo $result;

                for ($j = 1; $j < count($nietas); $j++) {
                    imprimirDietaConHijas($nietas[$j], 2,  $j);
                }
            } else {
                $result .= '<td class="border-start boder-end bg-warning"><input class="form-check-input" type="radio" value="' . $hijas[$i]->getMadre() . '" id="dieta" name="dieta"> <label class="form-check-label" for="flexCheckDefault"></label></td>';
                $result .= '</tr>';
                echo $result;
            }
        }
    } else {
        $result = '<tr>';
        $result .= '<td class="border-start">' . $dieta->getDescripcion()  . '</td>';
        $result .= '<td class="border-start border-end bg-warning"><input class="form-check-input" type="radio" value="' . $dieta->getMadre() . '" id="dieta" name="dieta"> <label class="form-check-label" for="flexCheckDefault"></label></td>';
        $result .= '</tr>';
        echo $result;
    }
}

$contenido = __DIR__ . "/view/crear.phtml";

require_once(__DIR__ . "/../view/pagina.phtml");

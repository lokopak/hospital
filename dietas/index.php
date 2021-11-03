<?php

require_once(__DIR__ . "/model/TablaDieta.php");

$dietas = TablaDieta::getInstancia()->getDietas();

/**
 * Imprime una fila de la tabla con una dieta sin dietas hijas.
 * 
 * @param Dieta $dieta Dieta a imprimir
 * @param int $cols [opcional] número de columnas a ocupar.
 */
function imprimirDietaSinHijas($dieta, $cols = 3)
{
    echo '<tr>
    <td> ' . $dieta->getDescripcion() . '<span class="text-muted fst-italic ms-3">(id: ' . $dieta->getMadre() . ')</span></td>
    <td colspan="' . $cols . '"></td>
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
        $result .= '<td class="border-end" rowspan="' . getRowspan($dieta) . '" colspan="' . getColspan($dieta, 3, 1) . '">' . $dieta->getDescripcion()  . '<span class="text-muted fst-italic ms-3">(id: ' . $dieta->getMadre() . ')</span></td>';
        if (!empty(($hijas = array_values($dieta->getHijas())))) {
            $hija = $hijas[0];
            $result .= '<td rowspan="' . getRowspan($hija) . '" colspan="' . getColspan($hija, 2, 1) . '">' . $hija->getDescripcion() . '<span class="text-muted fst-italic ms-3">(id: ' . $hija->getMadre() . ')</span></td>';
            if (!empty(($nietas = array_values($hija->getHijas())))) {
                $nieta = $nietas[0];
                $result .= '<td class="border-start">' . $nieta->getDescripcion() . '<span class="text-muted fst-italic ms-3">(id: ' . $nieta->getMadre() . ')</span></td>';
            }
            $result .= '</tr>';
            echo $result;

            for ($j = 1; $j < count($nietas); $j++) {
                imprimirDietaConHijas($hija, 2, $j);
            }
            imprimirDietaConHijas($dieta, 1);
        } else {
            $result .= '</tr>';
            echo $result;
        }
    } else if ($paso === 1) {
        $hijas = array_values($dieta->getHijas());
        for ($i = 1; $i < count($hijas); $i++) {
            $result = '<tr>';
            $result .= '<td class="" rowspan="' . getRowspan($hijas[$i]) . '" colspan="' . getColspan($hijas[$i], 2, 1) . '">' . $hijas[$i]->getDescripcion()  . '<span class="text-muted fst-italic ms-3">(id: ' . $hijas[$i]->getMadre() . ')</span></td>';
            if (!empty(($nietas = array_values($hijas[$i]->getHijas())))) {
                $nieta = $nietas[0];
                $result .= '<td class="border-start">' . $nieta->getDescripcion() . '<span class="text-muted fst-italic ms-3">(id: ' . $nieta->getMadre() . ')</span></td>';
                $result .= '</tr>';
                echo $result;

                for ($j = 1; $j < count($nietas); $j++) {
                    imprimirDietaConHijas($hijas[$i], 2,  $j);
                }
            } else {
                $result .= '</tr>';
                echo $result;
            }
        }
    } else {
        $hijas = array_values($dieta->getHijas());
        $result = '<tr>';
        $result .= '<td class="border-start">' . $hijas[$indice]->getDescripcion()  . '<span class="text-muted fst-italic ms-3">(id: ' . $hijas[$indice]->getMadre() . ')</span></td>';
        $result .= '</tr>';
        echo $result;
    }
}

$contenido = __DIR__ . "/view/index.phtml";

return require_once(__DIR__ . "/../view/pagina.phtml");
<?php

require_once __DIR__ . "/../services/Peticion.php";

$uri = ltrim(Peticion::getInstancia()->getUri(), '/');

// Eliminamos el query de la url en caso de que exista.
$uri = explode('?', $uri)[0];

function segmentoEnUrl($uri, $segmento)
{
    // No mostremos los índices.
    if (($pos = strpos($segmento, 'index.php')) > 0) {
        return $segmento;
    }

    return $segmento . '/index.php';
}

function esUltimoSegmento($segmentos, $i)
{
    if ($i < (count($segmentos) - 1)) {
        return false;
    }

    return true;
}

$segmentos = explode('/', $uri);

?>

<div class="bg-gray-200 text-sm">
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 py-3">
                <li class="breadcrumb-item fw-light <?= (count($segmentos) === 0 ? 'active' : '') ?>">
                    <?php if (count($segmentos) > 0) : ?>
                    <a href="/index.php">
                        <i class="fa fa-home me-2"></i>Inicio
                    </a>
                    <?php else : ?>
                    <span class="fw-light"><i class="fa fa-home me-2"></i>Inicio</span>
                    <?php endif; ?>
                </li>
                <?php
                $actual = '';
                $i = 0;
                foreach ($segmentos as $segmento) : ?>
                <?php if (strcmp($segmento, 'index.php') === 0) {
                        continue;
                    } ?>

                <?php $actual .= '/' . $segmento; ?>
                <li class="breadcrumb-item fw-light <?= (strpos($segmento, '.php') !== false ? 'active' : '') ?>"
                    <?= (strpos('.php', $segmento) !== false ? 'aria-current="page"' : '') ?>>
                    <?php if (esUltimoSegmento($segmentos, $i)) : ?>
                    <span class="fw-light"><?= ucfirst(str_replace('.php', '', $segmento)) ?></span>
                    <?php else : ?>
                    <a href="<?= segmentoEnUrl($segmentos, $actual) ?>">
                        <?= ucfirst(str_replace('.php', '', $segmento)) ?>
                    </a>
                    <?php endif; ?>
                </li>
                <?php $i++;
                endforeach; ?>
            </ol>
        </nav>
    </div>
</div>
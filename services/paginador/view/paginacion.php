<?php

/**
 * Este archivo muestra el contenido html de la barra de paginación.
 * 
 * Cuando queremos que los links sean relativos al índice base de la web y así
 * no tener que preocuparnos de en que lugar de la web nos encontramos en cada
 * momento, es preferible montar los links (parámetro href) empeznado con '/'
 * seguido de la ruta completa del destino al que queremos navegar.
 * De esta forma evitamos posibles fallos en la navegación.
 */
?>

<nav aria-label="Paginación">
    <ul class="pagination justify-content-center ">
        <?php
        if ($numeroPaginas > $maxPaginas) : ?>
        <li class="page-item<?= ($this->pagina > 1 ? '' : ' disabled') ?>">
            <a class="page-link" href="<?= $link ?>&pagina=1">Primera</a>
        </li>
        <?php endif; ?>
        <li class="page-item<?= ($this->pagina > 1 ? '' : ' disabled') ?>">
            <a href="<?= $link ?>&pagina=<?= $this->pagina - 1 ?>" class="page-link">Anterior</a>
        </li>
        <?php
        for ($i = $minPagina; $i < $maxPagina; $i++) {
            // Es la página actual
            if ($i === $this->pagina) {

        ?>
        <li class="page-item disabled"><a class="page-link" href="<?= $link ?>&pagina=<?= $i ?>"><?= $i ?></a></li>
        <?php
            } else {
            ?>


        <li class="page-item"><a class="page-link" href="<?= $link ?>&pagina=<?= $i  ?>"><?= $i ?></a>
        </li>
        <?php
            }
        }
        ?>
        <?php
        if ($i === $maxPaginas && $numeroPaginas > $maxPagina) : ?>
        <li class="page-item disabled">
            <span class="page-link">...</span>
        </li>
        <?php endif; ?>
        <li class="page-item<?= ($i === $maxPaginas) ? ' disabled' : '' ?>">
            <a class="page-link" href="<?= $link ?>&pagina=<?= $this->pagina + 1 ?>">Siguiente</a>
        </li>
        <?php
        if ($numeroPaginas > $maxPaginas) : ?>
        <li class="page-item">
            <a class="page-link" href="<?= $link ?>&pagina=<?= $numeroPaginas ?>">Última</a>
        </li>
        <?php endif; ?>
    </ul>
</nav>
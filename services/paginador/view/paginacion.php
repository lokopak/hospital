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
        if ($this->pagina > 1) {
        ?>
        <li class="page-item">
            <?php
        } else {
            // Es la primera página
            ?>
        <li class="page-item disabled">
            <?php
        }
            ?>
            <a href="<?= $link ?>&pagina=<?= $this->pagina - 1 ?>" class="page-link  btn-naranja">Anterior</a>
        </li>
        <?php
            for ($i = 1; $i <= $numeroPaginas; $i++) {
                // Es la página actual
                if ($i === $this->pagina) {

            ?>
        <li class="page-item disabled"><a class="page-link  btn-naranja"
                href="<?= $link ?>&pagina=<?= $i ?>"><?= $i ?></a></li>
        <?php
                } else {
                ?>


        <li class="page-item"><a class="page-link btn-naranja" href="<?= $link ?>&pagina=<?= $i ?>"><?= $i ?></a>
        </li>
        <?php
                }
            }
            // Es la última página
            if ($this->pagina === $numeroPaginas) {
                ?>
        <li class="page-item disabled">
            <?php
            } else {
                ?>
        <li class="page-item">
            <?php
            }
                ?>
            <a class="page-link  btn-naranja" href="<?= $link ?>&pagina=<?= $this->pagina + 1 ?>">Siguiente</a>
        </li>
    </ul>
</nav>
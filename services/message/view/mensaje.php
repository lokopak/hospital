<?php

/**
 * Este archivo muestra el contenido html de los mensajes que se han generado durante
 * la creación del contenido de la pagina solicitada y ejecución de la aplicación.
 * Cada error se compone de un array que contiene dos índices:
 *  - mensaje: El contenido del mensaje
 *  - tipo: Indica el tipo del mensaje.
 */

// Seleccionamos un icono para mostrar.
?>

<div class="toast-container position-absolute mt-5 top-0 end-0 p-3" id="toastPlacement">
    <?php
    // Mostramos todos los mensajes que se hayan producido.
    foreach ($mensajes as $mensaje) {
        switch ($mensaje['tipo']) {
            case 'success':
                $icono = 'check-circle';
                break;
            case 'warning':
                $icono = 'exclamation-triangle';
                break;
            case 'danger':
                $icono = 'exclamation-circle';
                break;
            case 'primary':
            default:
                $icono = 'info-circle';
        }
    ?>
    <div class="toast align-items-center text-white bg-<?= $mensaje["tipo"] ?> border-0 show" role="alert"
        aria-live="assertive" aria-atomic="true" data-bs-animation="true" data-bs-autohide="true" data-bs-delay="3000">
        <div class="d-flex">
            <div class="toast-body fs-4">
                <i class="bi bi-<?= $icono ?> me-3"></i><?= $mensaje["mensaje"]; ?>
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                aria-label="Cerrar"></button>
        </div>
    </div>
    <?php
    }
    ?>
</div>
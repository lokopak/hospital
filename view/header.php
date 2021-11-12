<header class="header">
    <nav class="navbar">
        <div class="container-fluid">
            <div class="d-flex align-items-center justify-content-between w-100">
                <div class="d-flex align-items-center">
                    <a class="menu-btn d-flex align-items-center justify-content-center p-2 bg-gray-900" id="toggle-btn" href="#">
                        <i class="fa fa-bars text-white"></i>
                    </a>
                    <a class="navbar-brand ms-2" href="/index.php">
                        <div class="brand-text d-none d-md-inline-block text-uppercase letter-spacing-0">
                            <span class="text-white fw-normal text-xs">Hospitalis </span>
                            <strong class="text-primary text-sm">Consulting</strong>
                        </div>
                    </a>
                </div>
                <form class="d-flex" method="POST" action="/buscar/buscar.php">
                    <div class="input-group">
                        <input type="text" name="valor" class="form-control" aria-label="Text input with dropdown button">
                        <select class="form-select" name="seccion" id="inputGroupSelect01">
                            <option selected value="todos">Buscar...</option>
                            <?php

                            require_once(__DIR__ . "/../login/services/ControlAcceso.php");
                            if (ControlAcceso::tieneAcceso('PACIENTES@VER')) : ?>
                                <option value="pacientes">Pacientes</option>
                            <?php endif; ?>
                            <?php

                
                            if (ControlAcceso::tieneAcceso('EMPLEADOS@VER')) : ?>
                                <option value="empleados">Empleados</option>
                            <?php endif; ?>
                            <!-- <option value="informes">Three</option> -->
                        </select>
                        <button class="btn btn-outline-secondary" type="submit" id="inputGroupFileAddon03">Buscar</button>
                    </div>
                </form>
                <ul class="nav-menu mb-0 list-unstyled d-flex flex-md-row align-items-md-center">

                    <li class="nav-item ms-3">
                        <!-- <a class="nav-link btn btn-danger text-white text-sm rounded-pill" href="/login/logout.php">
                            <span class="d-none d-sm-inline-block">Desconectar</span>
                            <i class="fa fa-power-off ms-2"></i>
                        </a> -->
                        <button class="nav-link btn btn-danger text-white text-sm rounded-pill" type="button" data-bs-toggle="modal" data-bs-target="#modalDesconectar">
                            <span class="d-none d-sm-inline-block">Desconectar</span>
                            <i class="fa fa-power-off ms-2"></i>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Modal -->
    <div class="modal fade" id="modalDesconectar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Desconectar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que quieres desconectarte?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary rounded-pill" onclick="document.location='/login/logout.php'">¡Claro que sí, Guapi!</button>
                </div>
            </div>
        </div>
    </div>
</header>
<?php
require_once __DIR__ . "/service/InyectorScript.php";

$script = "<script>
var myModalEl = document.getElementById('modalDesconectar')
myModalEl.addEventListener('hidden.bs.modal', function(event) {
    console.log(event);
})
</script>";
InyectorScript::getInstancia()->agregarScript($script);
?>
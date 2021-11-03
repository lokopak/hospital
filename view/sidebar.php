<?php
require_once __DIR__ . "/../services/Peticion.php";

$url = Peticion::getInstancia()->getUri();
?>
<nav class="side-navbar">
    <div class="sidebar-header d-flex align-items-center justify-content-center p-3 mb-3">
        <div class="sidenav-header-inner text-center"><img class="img-fluid rounded-circle avatar mb-3"
                src="/assets/images/person-no-image.png" alt="person">
            <h2 class="h5 text-white text-uppercase mb-0">Señor Usuario</h2>
            <p class="text-sm mb-0 text-muted">Cargo en hospital</p>
        </div><a class="brand-small text-center" href="/index.php">
            <p class="h1 m-0">HC</p>
        </a>
    </div>
    <ul class="list-unstyled">
        <li class="sidebar-item <?= (strcmp($url, "/index.php") === 0 ? 'active' : '') ?>">
            <a class="sidebar-link" href="/index.php">
                <i class="fa fa-home me-xl-2"></i>Inicio
            </a>
        </li>
        <li class="sidebar-item <?= (strpos($url, "/empleados") !== false ? 'active' : '') ?>">
            <a class="sidebar-link" href="#empleadosDropdown" data-bs-toggle="collapse">
                <i class="fa fa-user-circle-o me-xl-2"></i>Empleados
            </a>
            <ul class="collapsed list-unstyled <?= (strpos($url, "/empleados") === false ? 'collapse' : '') ?>"
                id="empleadosDropdown">
                <li <?= (strcmp($url, "/empleados/index.php") === 0 ? 'class="active"' : '') ?>><a class="sidebar-link"
                        href="/empleados/index.php">Listado de empleados</a></li>
                <li <?= (strpos($url, "/empleados/crear.php") !== false ? 'class="active"' : '') ?>><a
                        class="sidebar-link" href="/empleados/crear.php">Alta nuevo empleado</a></li>
            </ul>
        </li>
        <li class="sidebar-item <?= (strpos($url, "/pacientes") !== false ? 'active' : '') ?>">
            <a class="sidebar-link" href="#pacientesDropdown" data-bs-toggle="collapse">
                <i class="fa fa-bed me-xl-2"></i>Pacientes
            </a>
            <ul class="collapsed list-unstyled <?= (strpos($url, "/pacientes") === false ? 'collapse' : '') ?>"
                id="pacientesDropdown">
                <li <?= (strcmp($url, "/pacientes/index.php") === 0 ? 'class="active"' : '') ?>><a class="sidebar-link"
                        href="/pacientes/index.php">Listado de pacientes</a></li>
                <li <?= (strcmp($url, "/pacientes/crear.php") === 0 ? 'class="active"' : '') ?>><a class="sidebar-link"
                        href="/pacientes/crear.php">Alta nuevo paciente</a></li>
            </ul>
        </li>
        <li class="sidebar-item <?= (strpos($url, "/informes") !== false ? 'active' : '') ?>">
            <a class="sidebar-link" href="#informesDietasDropdown" data-bs-toggle="collapse">
                <i class="fa fa-area-chart me-xl-2"></i>Informes de dietas
            </a>
            <ul class="collapsed list-unstyled <?= (strpos($url, "/informes") === false ? 'collapse' : '') ?>"
                id="informesDietasDropdown">
                <li <?= (strcmp($url, "/informes/index.php") === 0 ? 'class="active"' : '') ?>><a class="sidebar-link"
                        href="/informes/index.php">Informes</a></li>
            </ul>
        </li>
        <li class="sidebar-item <?= (strpos($url, "/dietas") !== false ? 'active' : '') ?>">
            <a class="sidebar-link" href="#dietasDropdown" data-bs-toggle="collapse">
                <i class="fa fa-coffee me-xl-2"></i>Dietas
            </a>
            <ul class="collapsed list-unstyled <?= (strpos($url, "/dietas") === false ? 'collapse' : '') ?>"
                id="dietasDropdown">
                <li <?= (strcmp($url, "/dietas/index.php") === 0 ? 'class="active"' : '') ?>><a class="sidebar-link"
                        href="/dietas/index.php">Ver dietas</a></li>
            </ul>
        </li>
    </ul>
</nav>
<nav class="side-navbar">
    <div class="sidebar-header d-flex align-items-center justify-content-center p-3 mb-3">
        <div class="sidenav-header-inner text-center"><img class="img-fluid rounded-circle avatar mb-3"
                src="/assets/images/person-no-image.png" alt="person">
            <h2 class="h5 text-white text-uppercase mb-0">Señor Usuario</h2>
            <p class="text-sm mb-0 text-muted">Cargo en hospital</p>
        </div><a class="brand-small text-center" href="/">
            <p class="h1 m-0">HC</p>
        </a>
    </div>
    <ul class="list-unstyled">
        <li class="sidebar-item">
            <a class="sidebar-link" href="/">
                <i class="fa fa-home me-xl-2"></i>Inicio
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="#empleadosDropdown" data-bs-toggle="collapse">
                <i class="fa fa-user-circle-o me-xl-2"></i>Empleados
            </a>
            <ul class="collapse list-unstyled " id="empleadosDropdown">
                <li><a class="sidebar-link" href="/empleados">Listado de empleados</a></li>
                <li><a class="sidebar-link" href="/empleados/alta">Alta nuevo empleado</a></li>
            </ul>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="#pacientesDropdown" data-bs-toggle="collapse">
                <i class="fa fa-bed me-xl-2"></i>Pacientes
            </a>
            <ul class="collapse list-unstyled " id="pacientesDropdown">
                <li><a class="sidebar-link" href="/pacientes">Listado de pacientes</a></li>
                <li><a class="sidebar-link" href="/pacientes/alta">Alta nuevo paciente</a></li>
            </ul>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="#dietasDropdown" data-bs-toggle="collapse">
                <i class="fa fa-coffee me-xl-2"></i>Dietas
            </a>
            <ul class="collapse list-unstyled " id="dietasDropdown">
                <li><a class="sidebar-link" href="/informes">Informes</a></li>
                <li><a class="sidebar-link" href="/informes/nuevo">Nuevo informe</a></li>
            </ul>
        </li>
    </ul>
</nav>
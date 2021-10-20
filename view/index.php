<!DOCTYPE html>
<html lang="es">
<?php require(__DIR__ . "/head.php"); ?>


<body>
    <?php require(__DIR__ . "/sidebar.php"); ?>
    <div class="page">
        <header class="header">
            <nav class="navbar">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between w-100">
                        <div class="d-flex align-items-center">
                            <a class="menu-btn d-flex align-items-center justify-content-center p-2 bg-gray-900"
                                id="toggle-btn" href="#">
                                <i class="fa fa-bars text-white"></i>
                            </a>
                            <a class="navbar-brand ms-2" href="/hospital/index.php">
                                <div class="brand-text d-none d-md-inline-block text-uppercase letter-spacing-0">
                                    <span class="text-white fw-normal text-xs">Hospitalis </span>
                                    <strong class="text-primary text-sm">Consulting</strong>
                                </div>
                            </a>
                        </div>
                        <ul class="nav-menu mb-0 list-unstyled d-flex flex-md-row align-items-md-center">
                            <li class="nav-item dropdown">
                                <a class="nav-link text-white position-relative" id="notifications" rel="nofollow"
                                    data-bs-target="#" href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="fa fa-folder-open-o"></i>
                                    <span class="badge bg-warning rounded-pill">12</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end mt-sm-3 shadow-sm"
                                    aria-labelledby="notifications">
                                    <li>
                                        <a class="dropdown-item py-3" href="#!">
                                            <div class="d-flex">
                                                <div class="icon icon-sm bg-blue">
                                                    <i class="fa fa-envelope-o"></i>
                                                </div>
                                                <div class="ms-3">
                                                    <span class="h6 d-block fw-normal mb-1 text-xs text-gray-600">
                                                        Tienes 6 mensajes nuevos
                                                    </span>
                                                    <small class="small text-gray-600">hace 4 minutos</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item py-3" href="#!">
                                            <div class="d-flex">
                                                <div class="icon icon-sm bg-green">
                                                    <div class="icon icon-sm bg-blue">
                                                        <i class="fa fa-envelope-o"></i>
                                                    </div>
                                                </div>
                                                <div class="ms-3">
                                                    <span class="h6 d-block fw-normal mb-1 text-xs text-gray-600">
                                                        Tienes 2 mensajes de WhatsApp nuevos
                                                    </span>
                                                    <small class="small text-gray-600">hace 4 minutos</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item all-notifications text-center" href="#!">
                                            <strong class="text-xs text-gray-600">ver todas las notificaciones</strong>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link text-white position-relative" id="messages" rel="nofollow"
                                    data-bs-target="#" href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="fa fa-bell"></i>
                                    <span class="badge bg-info rounded-pill">10</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end mt-sm-3 shadow-sm"
                                    aria-labelledby="messages">
                                    <li><a class="dropdown-item d-flex py-3" href="#!">
                                            <img class="img-fluid rounded-circle flex-shrink-0 avatar shadow-0"
                                                src="/hospital/assets/images/person-no-image.png" alt="..." width="45">
                                            <div class="ms-3">
                                                <span class="h6 d-block fw-normal mb-1 text-sm text-gray-600">Jason
                                                    Doe</span>
                                                <small class="small text-gray-600"> Te ha enviado un mensaje</small>
                                                <p class="mb-0 small text-gray-600">
                                                    hace 3 días a las 7:58 pm - 21.10.2021
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li><a class="dropdown-item d-flex py-3" href="#!">
                                            <img class="img-fluid rounded-circle flex-shrink-0 avatar shadow-0"
                                                src="/hospital/assets/images/person-no-image.png" alt="..." width="45">
                                            <div class="ms-3">
                                                <span class="h6 d-block fw-normal mb-1 text-sm text-gray-600">
                                                    Jason Doe
                                                </span>
                                                <small class="small text-gray-600"> Te ha enviado un mensaje</small>
                                                <p class="mb-0 small text-gray-600"> hace 3 días a las 7:58 pm -
                                                    10.10.2021
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex py-3" href="#!">
                                            <img class="img-fluid rounded-circle flex-shrink-0 avatar shadow-0"
                                                src="/hospital/assets/images/person-no-image.png" alt="..." width="45">
                                            <div class="ms-3">
                                                <span class="h6 d-block fw-normal mb-1 text-sm text-gray-600">
                                                    Jason Doe
                                                </span>
                                                <small class="small text-gray-600"> Te ha enviado un mensaje</small>
                                                <p class="mb-0 small text-gray-600"> hace 3 días a las 7:58 pm -
                                                    10.10.2021
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item text-center" href="#!">
                                            <strong class="text-xs text-gray-600">Leer todos los mensajes </strong>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item ms-3">
                                <a class="nav-link btn btn-danger text-white text-sm rounded-pill" href="login.html">
                                    <span class="d-none d-sm-inline-block">Desconectar</span>
                                    <i class="fa fa-power-off ms-2"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <div class="bg-gray-200 text-sm">
            <div class="container-fluid">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 py-3">
                        <li class="breadcrumb-item"><a class="fw-light" href="index.html">
                                <i class="fa fa-home me-2"></i>Inicio
                            </a>
                        </li>
                        <li class="breadcrumb-item active fw-light" aria-current="page">Sección </li>
                    </ol>
                </nav>
            </div>
        </div>
        <header class="py-4">
            <div class="container-fluid py-2">
                <h1 class="h3 fw-normal mb-0">Sección</h1>
            </div>
        </header>
        <!-- Contenido de la página -->
        <section class="pb-5">
            <div class="container-fluid">
            </div>
        </section>
        <?php require(__DIR__ . "/footer.php"); ?>
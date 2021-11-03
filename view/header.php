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
                <ul class="nav-menu mb-0 list-unstyled d-flex flex-md-row align-items-md-center">
                    <li class="nav-item dropdown">
                        <a class="nav-link text-white position-relative" id="notifications" rel="nofollow" data-bs-target="#" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-folder-open-o"></i>
                            <span class="badge bg-warning rounded-pill">12</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end mt-sm-3 shadow-sm" aria-labelledby="notifications">
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
                        <a class="nav-link text-white position-relative" id="messages" rel="nofollow" data-bs-target="#" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-bell"></i>
                            <span class="badge bg-info rounded-pill">10</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end mt-sm-3 shadow-sm" aria-labelledby="messages">
                            <li><a class="dropdown-item d-flex py-3" href="#!">
                                    <img class="img-fluid rounded-circle flex-shrink-0 avatar shadow-0" src="/assets/images/person-no-image.png" alt="..." width="45">
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
                                    <img class="img-fluid rounded-circle flex-shrink-0 avatar shadow-0" src="/assets/images/person-no-image.png" alt="..." width="45">
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
                                    <img class="img-fluid rounded-circle flex-shrink-0 avatar shadow-0" src="/assets/images/person-no-image.png" alt="..." width="45">
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
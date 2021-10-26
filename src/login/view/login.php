<!DOCTYPE html>
<html>

<?php require(__DIR__ . "/../../view/head.php"); ?>

<body>
    <div class="login-page d-flex align-items-center bg-gray-100">
        <div class="container mb-3">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="card">
                        <div class="card-body p-5">
                            <header class="text-center mb-5">
                                <h1 class="text-xxl text-gray-400 text-uppercase">
                                    HOSPITALIS <strong class="text-primary">CONSULTING</strong>
                                </h1>
                                <p class="text-gray-500 fw-light">Introduce las credenciales de acceso.</p>
                            </header>
                            <form class="login-form" method="get" action="/hospital/login/login.php">
                                <div class="row">
                                    <div class="col-lg-7 mx-auto">
                                        <div class="input-material-group mb-3">
                                            <input class="input-material" id="DNI" type="text" name="DNI"
                                                autocomplete="off" required data-validate-field="DNI">
                                            <label class="label-material" for="login-username">Usuario</label>
                                        </div>
                                        <div class="input-material-group mb-4">
                                            <input class="input-material" id="login-password" type="password"
                                                name="password" required data-validate-field="password">
                                            <label class="label-material" for="login-password">Contraseña</label>
                                        </div>
                                    </div>
                                    <div class="col-12 text-center">
                                        <button class="btn btn-primary mb-3 rounded-pill" id="login"
                                            type="submit">Entrar</button>
                                        <br>
                                        <a class="text-xs text-paleBlue" href="/hospital/login/recuperar_password.php">
                                            ¿Has olvidado la contraseña?
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/hospital/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
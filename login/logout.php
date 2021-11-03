<?php

require_once(__DIR__ . "/../services/Sesion.php");

Sesion::desconectar();

header("location: /login/login.php");
exit;

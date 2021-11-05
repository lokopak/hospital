<?php

require_once(__DIR__ . "/../services/Sesion.php");

Sesion::getInstancia()->desconectar();

header("location: /login/login.php");
exit;
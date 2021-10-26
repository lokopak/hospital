<?php 
require_once (__DIR__."/model/Paciente.php");
$estados = Paciente::getEstados();

$contenido = __DIR__."/view/altaPacientes.php";

return require_once (__DIR__."/../view/pagina.phtml");
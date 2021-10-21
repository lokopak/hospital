<?php
require_once(__DIR__ . "/../model/ConexionDB.php");
$conexion = ConexionDB::getConexion();

?>

<h1>Listado empleados:</h1>
<hr />

<table class="table table-hover">
    <thead>
        <tr>
            <!--   <th scope="col">Código</th> -->
            <th scope="col">Id de paciente</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellidos</th>
            <th scope="col">Nº habitación</th>
            <th scope="col">Dieta</th>
            <th scope="col">Estado</th>
            <th scope="col">Fecha de registro</th>
            <th scope="col">Fecha de salida</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = 'SELECT  id,nombre,apellidos,habitacion,dieta,estado,fechaRegistro,fechaSalida	 FROM pacientes';

        $stmt  = $conexion->prepare($query);

        $resultado = $stmt->fetchAll();

        //print_r($resultado);

        $pacientes = [];

        foreach ($resultado as $paciente) {
            $paciente = new Empleado();
            $paciente->rellenar($registro);
            $pacientes[] = $paciente;
        }

        foreach ($pacientes as $paciente) {
            echo '<tr>';
            echo '<td>' . $paciente->getId() . '</td>';
            echo '<td>' . $paciente->getNombre() . '</td>';
            echo '<td>' . $paciente->getApellidos() . '</td>';
            echo '<td>' . $paciente->getHabitacion() . '</td>';
            echo '<td>' . $paciente->getDieta() . '</td>';
            echo '<td>' . $paciente->getEstado() . '</td>';
            echo '<td>' . $paciente->getFechaRegistro() . '</td>';
            echo '<td>' . $paciente->getfechaSalida() . '</td>';
            echo '<td>';
            echo '<td>';
            // echo '<a href="borrar.php?codigo='. $datos['id'] .'">Borrar</a>';
            //echo '<a href="actualizar.php?codigo='. $datos['id'] .'"><br>Editar</a>';
            echo '</td>';
            echo '</tr>';
        }
        ?>

    </tbody>
</table>

<?php
//include("../footer.php");
?>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
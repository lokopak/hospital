<?php
require_once(__DIR__ . "/../model/ConexionDB.php");
$conexion = ConexionDB::getConexion();

?>

<h1>Listado informes:</h1>
<hr />

<table class="table table-hover">
    <thead>
        <tr>
            <!--   <th scope="col">Código</th> -->
            <th scope="col">Id de informe</th>
            <th scope="col">Id de nutricionista</th>
            <th scope="col">Id de paciente</th>
            <th scope="col">Id de celador</th>
            <th scope="col">Dieta</th>
            <th scope="col">Fecha</th>
            <th scope="col">Desayuno</th>
            <th scope="col">1º comida</th>
            <th scope="col">2º comida</th>
            <th scope="col">3º comida</th>
            <th scope="col">Merienda</th>
            <th scope="col">1º cena</th>
            <th scope="col">2º cena</th>
            <th scope="col">3º cena</th>
            <th scope="col">Última modificación</th>
            <th scope="col">Último Editor</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = 'SELECT  id,idNutricionista,idPaciente,idCelador,dieta,fecha,desayuno,comida1,comida2,comida3,merienda,cena1,cena2,cena3,fechaModificacion,ultimoEditor FROM informes';

        $stmt  = $conexion->prepare($query);

        $resultado = $stmt->fetchAll();

        //print_r($resultado);

        $informes = [];

        foreach ($resultado as $informe) {
            $informe = new Empleado();
            $informe->rellenar($registro);
            $informes[] = $informe;
        }

        foreach ($informes as $informe) {
            echo '<tr>';
            echo '<td>' . $informe->getIdInforme(). '</td>';
            echo '<td>' . $informe->etIdNutricionista() . '</td>';
            echo '<td>' . $informe->getIdPaciente() . '</td>';
            echo '<td>' . $informe->getIdCelador() . '</td>';
            echo '<td>' . $informe->getDieta() . '</td>';
            echo '<td>' . $informe->getFecha() . '</td>';
            echo '<td>' . $informe->getDesayuno() . '</td>';
            echo '<td>' . $informe->getComida1() . '</td>';
            echo '<td>' . $informe->getComida2() . '</td>';
            echo '<td>' . $informe->getComida3() . '</td>';
            echo '<td>' . $informe->getMerienda() . '</td>';
            echo '<td>' . $informe->getCena1() . '</td>';
            echo '<td>' . $informe->getCena2() . '</td>';
            echo '<td>' . $informe->getCena3() . '</td>';
            echo '<td>' . $informe->getFechaModificacion() . '</td>';
            echo '<td>' . $informe->getUltimoEditortCena1() . '</td>';
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
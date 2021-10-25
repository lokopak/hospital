    <!-- Basic Form-->
    <form method="POST">
        <div class="row">
            <div class="card-group col-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h3 class="h4 mb-0">Datos Paciente</h3>
                    </div>
                    <div class="card-body">
                        <p class="text-sm">Por favor, inserte los datos del paciente.</p>

                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="nombre">Nombre</label>
                            <input class="form-control" id="nombre" type="text" name="nombre" aria-describedby="Nombre">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="apellidos">Apellidos</label>
                            <input class="form-control" id="apellidos" name="apellidos" type="text">
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label" for="habitacion">Habitación</label>
                            <input class="form-control" id="habitacion" name="habitacion" type="text">
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label" for="estado">Estado</label>
                            <select class="form-select" id="estado" name="estado">
                                <option selected value="-1">decide</option>
                                <?php foreach ($estados as $indice => $estado) { ?>
                                    <option value="<?= $indice ?>"><?= ucfirst($estado) ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </div>
            </div>
        </div>

        <?php
        require_once(__DIR__ . "/../../dietas/model/TablaDieta.php");
        $tablaDietas = new TablaDieta();
        $dietas = $tablaDietas->getDietas();
        require_once(__DIR__ . "/../../dietas/view/index.phtml");
        ?>


    </form>
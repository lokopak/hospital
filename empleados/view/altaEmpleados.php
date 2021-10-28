<!-- Basic Form-->
<form class="row" method="POST">
    <div class="card-group">
        <div class="card">
            <div class="card-header border-bottom">
                <h3 class="h4 mb-0">Datos empleados</h3>
            </div>
            <div class="card-body">
                <p class="text-sm">Por favor, inserte los datos del empleado.</p>

                <div class="mb-3">
                    <label class="form-label" for="nombre">Nombre</label>
                    <input class="form-control" id="nombre" name="nombre" type="text" aria-describedby="Nombre">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="apellidos">Apellidos</label>
                    <input class="form-control" id="apellidos" name="apellidos" type="text">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="DNI">DNI</label>
                    <input class="form-control" id="DNI" name="DNI" type="text">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="cargo">Cargo</label>
                    <select class="form-select" id="cargo" name="cargo">
                        <option selected value="-1">decide</option>
                        <?php foreach ($cargos as $indice => $cargo) { ?>
                        <option value="<?= $indice ?>"><?= ucfirst($cargo) ?></option>
                        <?php } ?>
                    </select>
                </div>
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>
        </div>
    </div>
</form>
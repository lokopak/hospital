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

    <div class="col-12 col-lg-6">
        <div class="card">
            <div class="card-header border-bottom">
                <h3 class="h4 mb-0">Datos Empelado.</h3>
            </div>
            <div class="card-body">
                <p class="text-sm">Por favor, inserte los datos del empleado.</p>
                <div class="mb-3">
                    <label class="form-label" for="apellidos">Dieta</label>
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne" aria-expanded="false"
                                    aria-controls="flush-collapseOne">
                                    Accordion Item #1
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">Placeholder content for this accordion, which is intended to
                                    demonstrate the <code>.accordion-flush</code> class. This is the first item's
                                    accordion body.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseTwo" aria-expanded="false"
                                    aria-controls="flush-collapseTwo">
                                    Accordion Item #2
                                </button>
                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">Placeholder content for this accordion, which is intended to
                                    demonstrate the <code>.accordion-flush</code> class. This is the second item's
                                    accordion body. Let's imagine this being filled with some actual content.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseThree" aria-expanded="false"
                                    aria-controls="flush-collapseThree">
                                    Accordion Item #3
                                </button>
                            </h2>
                            <div id="flush-collapseThree" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">Placeholder content for this accordion, which is intended to
                                    demonstrate the <code>.accordion-flush</code> class. This is the third item's
                                    accordion body. Nothing more exciting happening here in terms of content, but just
                                    filling up the space to make it look, at least at first glance, a bit more
                                    representative of how this would look in a real-world application.</div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</form>
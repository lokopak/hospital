          <div class="row row-cols-2 row-cols-md-4 card-group g-4 mb-5">
              <!-- Count item widget-->
              <div class="col">
                  <div class="card text-white bg-primary col">
                      <div class="card-body d-flex">
                          <i class="fa fa-users fa-2x"></i>
                          <div class="ms-3">
                              <h3 class="h4 text-uppercase fw-normal">Pacientes actuales</h3>
                              <p class="text-gray-400 small">Total</p>
                              <p class="display-6 mb-0"><?= $numeroPacientes ?></p>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col">
                  <div class="card text-white bg-success col">
                      <div class="card-body d-flex">
                          <i class="fa fa-users fa-2x"></i>
                          <div class="ms-3">
                              <h3 class="h4 text-uppercase fw-normal">Altas de Pacientes</h3>
                              <p class="text-gray-400 small">Total</p>
                              <p class="display-6 mb-0"><?= $numeroAltaPacientes ?></p>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col">
                  <div class="card text-white bg-danger">
                      <div class="card-body d-flex">
                          <i class="fa fa-users fa-2x"></i>
                          <div class="ms-3">
                              <h3 class="h4 text-uppercase fw-normal">Defunciones de Pacientes</h3>
                              <p class="text-gray-200 small">Total</p>
                              <p class="display-6 mb-0"><?= $numeroDefunciones ?></p>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col">
                  <div class="card text-white bg-warning">
                      <div class="card-body d-flex">
                          <i class="fa fa-users fa-2x"></i>
                          <div class="ms-3">
                              <h3 class="h4 text-uppercase fw-normal">Número de informes </h3>
                              <p class="text-gray-700 small">Total</p>
                              <p class="display-6 mb-0"><?= $numeroInformes ?></p>
                          </div>
                      </div>
                  </div>
              </div>
          </div>

          <div class="row row-cols-2 row-cols-md-4 card-group g-4 mb-5">
              <div class="col-3 mx-auto">
                  <canvas id="pieChart" style="width: 300px; height: 300px; max-width: 100%"> </canvas>
              </div>
          </div>


          <?php
            require_once __DIR__ . "/service/InyectorScript.php";
            $script = '<script src="/assets/vendor/chart.js/Chart.min.js"></script>';
            InyectorScript::getInstancia()->agregarScript($script);
            $script =
            '<script>
            var brandPrimary = "#33b35a";
              var PIECHART = document.getElementById("pieChart");
              var myPieChart = new Chart(PIECHART, {
                  type: "doughnut",
                  data: {
                      labels: ["Pacientes actuales", "Altas de pacientes", "Defunciones pacientes", "Número de informes"],
                      datasets: [{
                          data: ['. $numeroPacientes . ', ' . $numeroAltaPacientes . ',' . $numeroDefunciones . ', ' . $numeroInformes . '],
                          borderWidth: [1, 1, 1, 1],
                          backgroundColor: ["rgba(75,192,192,1)",brandPrimary, "#dc3545", "#FFCE56"],
                          hoverBackgroundColor: ["rgba(75,192,192,1)",brandPrimary, "#dc3545", "#FFCE56"],
                      }, ],
                  },
              });
          </script>';
            InyectorScript::getInstancia()->agregarScript($script);
            ?>
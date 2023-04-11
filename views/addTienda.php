<div id="app">
    <?php
    session_start();
    require_once("layouts/aside.php");
    ?>
    <div id="main">
      <div class="page-heading">
          <div class="page-title">
            <div class="row">
              <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Registrar Tienda</h3>
                <p class="text-subtitle text-muted">
                  Ingrese los datos que se solicitan a continuacion.
                </p>
              </div>
            </div>
          </div>

          <!-- // Basic multiple Column Form section start -->
          <section id="multiple-column-form">
            <div class="row match-height">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">Nueva Tienda</h4>
                  </div>
                  <div class="card-content">
                    <div class="card-body">
                      <form class="form" action="index.php" method="post" data-parsley-validate>
                        <div class="row">
                          <div class="col-md-6 col-12">
                            <div class="form-group mandatory">
                              <label for="first-name-column" class="form-label"
                                >Nombre</label
                              >
                              <input
                                type="text"
                                id="first-name-column"
                                class="form-control"
                                placeholder="First Name"
                                name="name"
                                data-parsley-required="true"
                              />
                            </div>
                          </div>
                          
                        </div>
                        <div class="row">
                          <div class="col-12">
                            <div class="form-group mandatory">
                              <fieldset>
                                <label class="form-label">
                                  Activa:
                                </label>
                                <div class="form-check">
                                  <input
                                    class="form-check-input"
                                    type="radio"
                                    name="flexRadioDefault"
                                    id="flexRadioDefault1"
                                    data-parsley-required="true"
                                  />
                                  <label
                                    class="form-check-label form-label"
                                    for="flexRadioDefault1"
                                  >
                                    Activada
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input
                                    class="form-check-input"
                                    type="radio"
                                    name="flexRadioDefault"
                                    id="flexRadioDefault2"
                                  />
                                  <label
                                    class="form-check-label form-label"
                                    for="flexRadioDefault2"
                                  >
                                    Desactivado
                                  </label>
                                </div>
                              </fieldset>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-12 d-flex justify-content-end">
                            <button
                              type="submit"
                              class="btn btn-primary me-1 mb-1"
                            >
                              Añadir
                            </button>
                            <input type="hidden" name="m" value="addTienda">
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <!-- // Basic multiple Column Form section end -->
        </div>
      <?php
      require_once("layouts/footer.php");
      ?>
    </div>
  </div>
    <script src="assets/static/js/components/dark.js"></script>
    <script src="assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>

    <script src="assets/compiled/js/app.js"></script>

    <!-- Need: Apexcharts -->
    <script src="assets/extensions/apexcharts/apexcharts.min.js"></script>
    <script src="assets/static/js/pages/dashboard.js"></script>
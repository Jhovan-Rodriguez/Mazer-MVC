<title>Editar tienda</title>
<div id="app">
  <?php
  session_start();
  require_once("layouts/aside.php");
  include_once("model/index.php");
  //Consulta para traer información de la tienda
  $model = new Model();
  $datos_tienda = $model->consultaTienda($_POST['id']);
  ?>
  <div id="main">
    <div class="page-heading">
      <div class="page-title">
        <div class="row">
          <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Editar Tienda</h3>
            <p class="text-subtitle text-muted">
              Modifique los datos que necesite.
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
                <h4 class="card-title">Nombre de Tienda</h4>
              </div>
              <div class="card-content">
                <div class="card-body">
                  <?php foreach ($datos_tienda as $data => $value) { ?>
                    <form class="form needs-validation" action="index.php" method="post" novalidate>
                      <div class="row">
                        <div class="col-md-6 col-12">
                          <div class="form-group mandatory">
                            <label for="first-name-column" class="form-label">Nombre</label>
                            <input type="text" id="first-name-column" class="form-control" placeholder="First Name"
                              name="nombre" value="<?php echo $value['nombre'] ?>" required />
                            <input type="hidden" name="id" value="<?php echo $value['id'] ?>">
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
                              <?php if ($value['activa'] == 1) { ?>
                                <div class="form-check">
                                  <input type="radio" class="form-check-input" id="validationFormCheck2"
                                    name="radio-stacked" value="1" required checked>
                                  <label class="form-check-label" for="validationFormCheck2">Activada</label>
                                </div>
                                <div class="form-check mb-3">
                                  <input type="radio" class="form-check-input" id="validationFormCheck3"
                                    name="radio-stacked" value="0" required>
                                  <label class="form-check-label" for="validationFormCheck3">Desactivada</label>
                                </div>
                              <?php } else { ?>
                                <div class="form-check">
                                  <input type="radio" class="form-check-input" id="validationFormCheck2"
                                    name="radio-stacked" value="1" required>
                                  <label class="form-check-label" for="validationFormCheck2">Activada</label>
                                </div>
                                <div class="form-check mb-3">
                                  <input type="radio" class="form-check-input" id="validationFormCheck3"
                                    name="radio-stacked" value="0" required checked>
                                  <label class="form-check-label" for="validationFormCheck3">Desactivada</label>
                                </div>
                              <?php }
                  } ?>
                          </fieldset>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-1 mb-1">
                          Actualizar
                        </button>
                        <input type="hidden" name="m" value="EditTienda">
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
<script src="js/validacionForm.js"></script>
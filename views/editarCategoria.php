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
            <h3>Editar Categoria</h3>
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
                <h4 class="card-title">Categoria
                  <?php echo $data_categoria['nombre']; ?>
                </h4>
              </div>
              <div class="card-content">
                <div class="card-body">
                  <form class="form needs-validation" action="index.php" method="post" novalidate>
                    <div class="row">
                      <div class="col-md-6 col-12">
                        <div class="form-group mandatory">
                          <label for="first-name-column" class="form-label">Nombre</label>
                          <input type="text" id="first-name-column" class="form-control"
                            placeholder="Nombre de la categoria" name="name"
                            value="<?php echo $data_categoria['nombre']; ?>" required />
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 col-12">
                        <div class="form-group mandatory">
                          <label for="first-name-column" class="form-label">Descripcion</label>
                          <input type="text" id="first-name-column" class="form-control"
                            placeholder="Descripcion de la categoria" name="descripcion"
                            value="<?php echo $data_categoria['descripcion']; ?>" required />
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-1 mb-1">
                          Añadir
                        </button>
                        <input type="hidden" name="m" value="updateCategoria">
                        <input type="hidden" name="id" value="<?php echo $data_categoria['id']; ?>" />
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
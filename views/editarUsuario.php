<link rel="stylesheet" href="assets/extensions/sweetalert2/sweetalert2.min.css" />
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
                <h3>Usuario <?php echo $data_categoria['user_name'] ?></h3>
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
                    <h4 class="card-title">Actualizar Usuario</h4>
                  </div>
                  <div class="card-content">
                    <div class="card-body">
                      <form class="form" action="index.php" method="post" data-parsley-validate>
                        <div class="row">
                          <div class="col-12">
                            <div class="form-group mandatory">
                              <label for="first-name-column" class="form-label"
                                >Nombre</label
                              >
                              <input
                                type="text"
                                id="first-name-column"
                                class="form-control"
                                placeholder="Nombre del usuario"
                                name="name"
                                value="<?php echo $data_categoria['nombre'] ?>"
                                data-parsley-required="true"
                                required
                              />
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-12">
                            <div class="form-group mandatory">
                              <label for="first-name-column" class="form-label"
                                >Apellido Paterno</label
                              >
                              <input
                                type="text"
                                id="first-name-column"
                                class="form-control"
                                placeholder="Apellido paterno del usuario"
                                name="apellido_p"
                                value="<?php echo $data_categoria['apellido_p'] ?>"
                                data-parsley-required="true"
                                required
                              />
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-12">
                            <div class="form-group mandatory">
                              <label for="first-name-column" class="form-label"
                                >Apellido Materno</label
                              >
                              <input
                                type="text"
                                id="first-name-column"
                                class="form-control"
                                placeholder="Apellido materno del usuario"
                                name="apellido_m"
                                value="<?php echo $data_categoria['apellido_m'] ?>"
                                data-parsley-required="true"
                                required
                              />
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-12">
                            <div class="form-group mandatory">
                              <label for="first-name-column" class="form-label"
                                >Nombre de Usuario</label
                              >
                              <input
                                type="text"
                                id="first-name-column"
                                class="form-control"
                                placeholder="Nombre de usuario(usado en login)"
                                name="user_name"
                                value="<?php echo $data_categoria['user_name'] ?>"
                                data-parsley-required="true"
                                required
                              />
                            </div>
                          </div>
                        </div>
                        <!-- <div class="row">
                          <div class="col-12">
                            <div class="form-group mandatory">
                              <label for="first-name-column" class="form-label"
                                >Contraseña</label
                              >
                              <input
                                type="password"
                                id="first-name-column"
                                class="form-control"
                                placeholder="Ingrese una contraseña"
                                name="pass"
                                value="<?php echo $data_categoria['user_password'] ?>"
                                data-parsley-required="true"
                                required
                              />
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-12">
                            <div class="form-group mandatory">
                              <label for="first-name-column" class="form-label"
                                >Confirmar Contraseña</label
                              >
                              <input
                                type="password"
                                id="first-name-column"
                                class="form-control"
                                placeholder="Confirme la contraseña"
                                name="conf_pass"
                                value="<?php echo $data_categoria['user_password'] ?>"
                                data-parsley-required="true"
                                required
                              />
                            </div>
                          </div>
                        </div> -->
                        <div class="row">
                          <div class="col-12">
                            <div class="form-group mandatory">
                              <label for="first-name-column" class="form-label"
                                >E-mail</label
                              >
                              <input
                                type="email"
                                id="first-name-column"
                                class="form-control"
                                placeholder="Ingrese un correo electronico"
                                name="email"
                                value="<?php echo $data_categoria['user_email'] ?>"
                                data-parsley-required="true"
                                required
                              />
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
                            <input type="hidden" name="id" value="<?php echo $data_categoria['id'] ?>">
                            <input type="hidden" name="m" value="updateUsuario">
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
    <script src="assets/extensions/sweetalert2/sweetalert2.min.js"></script>
    <script src="assets/static/js/pages/sweetalert2.js"></script>
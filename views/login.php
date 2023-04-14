<div id="auth">
    <div class="row h-100">
      <div class="col-lg-5 col-12">
        <div id="auth-left">
          <div class="auth-logo">
            <a href="index.html"><img src="assets/compiled/svg/logo.svg" alt="Logo" /></a>
          </div>
          <h1 class="auth-title">Log in.</h1>
          <p class="auth-subtitle mb-5">
            Ingresa con tus datos de usuario!
          </p>

          <form action="index.php" method="post">
            <div class="form-group position-relative has-icon-left mb-4">
              <input type="text" name="nombre" class="form-control form-control-xl" placeholder="Usuario" />
              <div class="form-control-icon">
                <i class="bi bi-person"></i>
              </div>
            </div>
            <div class="form-group position-relative has-icon-left mb-4">
              <input type="password" name="password" class="form-control form-control-xl" placeholder="Contraseña" />
              <div class="form-control-icon">
                <i class="bi bi-shield-lock"></i>
              </div>
            </div>
            <button type="submit" name="btnlogin" class="btn btn-primary btn-block btn-lg shadow-lg mt-2">
              Log in
            </button>
            <input type="hidden" name="m" value="login">
          </form>

        </div>
      </div>
      <div class="col-lg-7 d-none d-lg-block">
        <div id="auth-right" style="display:grid;">
        <div class="col-md-7" style="margin:auto;">
                <div class="card">
                  <div class="card-content">
                    <div class="card-body">
                      <h4 class="card-title">INTEGRANTES</h4>
                      <p class="card-text">
                      Hernández Campillo Kevin Alejandro
                      Rodriguez Moreno Jorge Jhovan
                      </p>
                      </div>
                  </div>
                </div>
              </div>

        </div>
      </div>
    </div>
  </div>
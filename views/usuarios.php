<?php 
  session_start();
  if(!(isset($_SESSION['nombre']))){

    require_once("../config.php");
    header("location:".urlsite);
  }else{
?>
<title>Tiendas</title>
<div id="app">
    <?php
    require_once("layouts/aside.php");
    ?>
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            <div class="row">
                <div class="col-md-9">
                    <h3>Usuarios</h3>
                </div>
                <div class="col-md-2">
                    <a href="#" data-function>
                        <span data-options='[["m","viewAddUsuario"]]' class="badge bg-success">Agregar Nuevo Usuario</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="page-content">
            <section class="row">
                <div class="card">
                    <div class="card-body">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Usuario</th>
                                    <th>E-mail</th>
                                    <th>Fecha Agregado</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($dato)):
                                    foreach ($dato as $key => $value): foreach ($value as $v): ?>
                                            <tr>
                                                <th>
                                                    <?php echo $v['id'] ?>
                                                </th>
                                                <th>
                                                    <?php echo $v['nombre'] ?>
                                                </th>
                                                <th>
                                                    <?php echo $v['apellido_p']." "; echo $v['apellido_m']; ?>
                                                </th>
                                                <th>
                                                    <?php echo $v['user_name'] ?>
                                                </th>
                                                <th>
                                                    <?php echo $v['user_email'] ?>
                                                </th>
                                                <th>
                                                    <?php echo $v['date_added'] ?>
                                                </th>
                                                <th>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown" >
                                                            <i class="bi bi-three-dots-vertical"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="#" data-function data-options='[["m","viewEditUsuario"],["id","<?php echo $v['id'] ?>"]]'><i class="bi bi-pencil-square text-warning m-1"></i>Editar</a>
                                                            <a class="dropdown-item" href="#" data-function data-options='[["m","delUsuario"],["id","<?php echo $v['id'] ?>"]]'><i class="bi bi-trash3-fill text-danger m-1"></i>Eliminar</a>
                                                        </div>
                                                    </div>
                                                </th>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <th colspan="7"> No hay registros </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
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
<script src="assets/extensions/jquery/jquery.min.js"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
<script src="assets/static/js/pages/datatables.js"></script>
<?php } ?>
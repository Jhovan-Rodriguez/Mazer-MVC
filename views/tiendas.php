<?php
session_start();
if (!(isset($_SESSION['nombre']))) {

    require_once("../config.php");
    header("location:" . urlsite);
} else {
    ?>

    <title>Tiendas</title>
    <link rel="stylesheet" href="assets/extensions/sweetalert2/sweetalert2.min.css" />
    <?php
    include("../model/index.php");
    $modelo = new Model;
    $dato = $modelo->mostrar_tiendas();
    ?>
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
                        <h3>Tiendas</h3>
                    </div>
                    <div class="col-md-2">
                        <a href="#" data-function>
                            <span data-options='[["m","viewAddTienda"]]' class="badge bg-success">Agregar Nueva
                                Tienda</span>
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
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Activa</th>
                                        <th>Acciones</th>
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
                                                    <?php if ($v['activa'] == 1) { ?>
                                                        <th><span class="badge bg-success">Activa</span></th>
                                                    <?php } else { ?>
                                                        <th><span class="badge bg-danger">Inactiva</span></th>
                                                    <?php } ?>
                                                    <th>
                                                        <div class="dropdown">
                                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                                data-bs-toggle="dropdown">
                                                                <i class="bi bi-three-dots-vertical"></i>
                                                            </button>
                                                            <div class="modal-danger me-1 mb-1 d-inline-block">
                                                                <!-- Button trigger for danger theme modal -->
                                                                <button style="display:none;" type="button"
                                                                    class="btn btn-outline-danger" data-bs-toggle="modal"
                                                                    data-bs-target="#danger<?php echo $v['id']; ?>"
                                                                    id="<?php echo $v['id'] ?>">
                                                                    Danger
                                                                </button>
                                                                <!--Danger theme Modal -->
                                                                <div class="modal fade text-left" id="danger<?php echo $v['id']; ?>"
                                                                    tabindex="-1" role="dialog" aria-labelledby="myModalLabel120"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                                        role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header bg-danger">
                                                                                <h5 class="modal-title white" id="myModalLabel120">
                                                                                    ¿Desea Eliminar esta tienda?
                                                                                </h5>
                                                                                <button type="button" class="close"
                                                                                    data-bs-dismiss="modal" aria-label="Close">
                                                                                    <i data-feather="x"></i>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-light-secondary"
                                                                                    data-bs-dismiss="modal">
                                                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                                                    <span class="d-none d-sm-block">Close</span>
                                                                                </button>
                                                                                <button type="button" class="btn btn-danger ms-1"
                                                                                    data-bs-dismiss="modal">
                                                                                    <a class="dropdown-item" href="#" data-function
                                                                                        data-options='[["m","delTienda"],["id","<?php echo $v['id']; ?>"]]'><i
                                                                                            class="bi bi-trash3-fill m-1"></i>Aceptar</a>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="#" data-function
                                                                    data-options='[["m","viewEditTienda"],["id","<?php echo $v['id'] ?>"]]'><i
                                                                        class="bi bi-pencil-square text-warning m-1"></i>Editar</a>
                                                                <a class="dropdown-item" href="#"
                                                                    onclick="modal(<?php echo $v['id'] ?>)"><i
                                                                        class="bi bi-trash3-fill text-danger m-1"></i>Eliminar</a>
                                                                <a class="dropdown-item" href="#" data-function
                                                                    data-options='[["m","InTienda"],["id","<?php echo $v['id'] ?>"]]'><i
                                                                        class="bi bi-box-arrow-in-up-right text-success m-1"></i>Ingresar</a>
                                                            </div>
                                                        </div>
                                                    </th>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <th colspan="3"> No hay registros </td>
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
    <script>
        //Funcion para abrir el modal de eliminar 
        function modal(id_tienda) {
            $('#' + id_tienda).click();
        }
    </script>
    <script src="assets/static/js/components/dark.js"></script>
    <script src="assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/compiled/js/app.js"></script>

    <!-- Need: Apexcharts -->
    <script src="assets/extensions/apexcharts/apexcharts.min.js"></script>
    <script src="assets/static/js/pages/dashboard.js"></script>
    <script src="assets/extensions/jquery/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="assets/static/js/pages/datatables.js"></script>
    <script src="assets/extensions/sweetalert2/sweetalert2.min.js"></script>
    <script src="assets/static/js/pages/sweetalert2.js"></script>
<?php } ?>
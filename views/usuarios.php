<?php
session_start();
if (!(isset($_SESSION['nombre']))) {

    require_once("../config.php");
    header("location:" . urlsite);
} else {
    ?>
    <title>Usuarios</title>
    <div id="app">
        <?php
        require_once("layouts/aside.php");
        include("../model/index.php");
        $tiendas   = new Model();
        $condition = "id_tienda='".$_SESSION['id_tienda']."'";
        $dato       = $tiendas->mostrar('users',$condition);
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
                    <div class="col-md-2" style="display: flex;" >
                    <a href="#" data-backup class="m-1"title="Desacer cambios realizados (Z)">
                    <?php
                        if(empty($data_backup)){
                    ?>
                            <span id="Back" class="badge bg-secondary" data-options='<?php echo $data_backup; ?>'><i class="fa-solid fa-rotate-left"></i> Desacer cambio</span>    
                        <?php
                        }else{
                        ?>
                            <span id="Back" class="badge bg-success" data-options='<?php echo $data_backup; ?>'><i data-options='<?php echo $data_backup; ?>' class="fa-solid fa-rotate-left"></i> Desacer cambio</span>
                        <?php
                        } 
                        ?>
                        
                    </a>
                        <a href="#" data-function class="m-1" title="Añadir elemento(I)">
                            <span id="Add" data-options='[["m","viewAddUsuario"]]' class="badge bg-success">Agregar Usuario</span>
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
                                                        <?php echo $v['apellido_p'] . " ";
                                                        echo $v['apellido_m']; ?>
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
                                                                                    ¿Desea eliminar este usuario?
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
                                                                                        data-options='[["m","delUsuario"],["id","<?php echo $v['id']; ?>"]]'><i
                                                                                            class="bi bi-trash3-fill m-1"></i>Aceptar</a>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="#" data-function
                                                                    data-options='[["m","viewEditUsuario"],["id","<?php echo $v['id'] ?>"]]'><i
                                                                        class="bi bi-pencil-square text-warning m-1"></i>Editar</a>
                                                                <a class="dropdown-item" onclick="modal(<?php echo $v['id'] ?>)"><i
                                                                        class="bi bi-trash3-fill text-danger m-1"></i>Eliminar</a>
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
    <script>
        //Funcion para abrir el modal de eliminar 
        function modal(id_usuario) {
            $('#' + id_usuario).click();
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
<?php } ?>
<title>Inventario</title>
<link rel="stylesheet" href="assets/extensions/sweetalert2/sweetalert2.min.css" />
<div id="app">
    <?php
    require_once("layouts/aside.php");
    include("../model/index.php");
    $nombre_tienda = $_SESSION['nombre_tienda'];
    $inventario = new Model();
    $dato = $inventario->get_productos($nombre_tienda);
    if(!empty($dato)){
        $categoria = $inventario->get_categoria($dato);

    }
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
                    <h3>Inventario</h3>
                </div>
                <div class="col-md-2">
                    <a href="#" data-function>
                        <span data-options='[["m","viewAddProducto"]]' class="badge bg-success">Agregar producto</span>
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
                                    <th>Codigo</th>
                                    <th>Nombre</th>
                                    <th>Fecha Agregado</th>
                                    <th>Precio Producto</th>
                                    <th>Categoria</th>
                                    <th>Stock</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($dato)) {
                                    foreach ($dato as $key => $data) { ?>
                                        <tr>
                                            <td>
                                                <?php echo $data['codigo']; ?>
                                            </td>
                                            <td>
                                                <?php echo $data['nombre']; ?>
                                            </td>
                                            <td>
                                                <?php echo $data['date_added']; ?>
                                            </td>
                                            <td>$
                                                <?php echo $data['precio']; ?>
                                            </td>
                                            <td>
                                                <?php echo $data['cat_nombre']; ?>

                                            </td>
                                            <td>
                                                <?php echo $data['stock']; ?>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown">
                                                        <i class="bi bi-three-dots-vertical"></i>
                                                    </button>
                                                    <div class="modal-danger me-1 mb-1 d-inline-block" >
                                                        <!-- Button trigger for danger theme modal -->
                                                        <button type="button" class="btn btn-outline-danger"
                                                            data-bs-toggle="modal" data-bs-target="#danger<?php echo $data['id']; ?>" style="display:none;" id="<?php echo $data['id'] ?>">
                                                            Danger
                                                        </button>
                                                        <!--Danger theme Modal -->
                                                        <div class="modal fade text-left" id="danger<?php echo $data['id']; ?>" tabindex="-1"
                                                            role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                                role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-danger">
                                                                        <h5 class="modal-title white" id="myModalLabel120">
                                                                            ¿Desea Eliminar este producto?
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
                                                                                data-options='[["m","delProducto"],["id","<?php echo $data['id']; ?>"]]'><i
                                                                                    class="bi bi-trash3-fill m-1"></i>Aceptar</a>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#" data-function
                                                            data-options='[["m","viewEditProducto"],["id","<?php echo $data['id']; ?>"]]'><i
                                                                class="bi bi-pencil-square text-warning m-1"></i>Editar</a>
                                                        <a class="dropdown-item" onclick="modal(<?php echo $data['id'] ?>)"><i
                                                                class="bi bi-trash3-fill text-danger m-1"></i>Eliminar</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                    <?php } ?>
                                <?php } else { ?>
                                    <tr>
                                        <th colspan="7"> No hay registros </td>
                                    </tr>
                                <?php } ?>
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
function modal(id_usuario){
    $('#'+id_usuario).click();
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
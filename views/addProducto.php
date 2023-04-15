<title>Registrar productos</title>
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
                        <h3>Registrar Producto</h3>
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
                                <h4 class="card-title">Nuevo Producto</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <form class="form needs-validation" action="index.php" method="POST" novalidate>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mandatory">
                                                    <label for="first-name-column" class="form-label">Código</label>
                                                    <input type="number" id="first-name-column" class="form-control"
                                                        placeholder="Código de producto" name="codigo" required />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mandatory">
                                                    <label for="first-name-column" class="form-label">Nombre</label>
                                                    <input type="text" id="first-name-column" class="form-control"
                                                        placeholder="Nombre del producto" name="nombre" required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mandatory">
                                                    <label for="first-name-column" class="form-label">Precio</label>
                                                    <input type="number" id="first-name-column" class="form-control"
                                                        placeholder="Ingrese precio de producto" name="precio"
                                                        required />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mandatory">
                                                    <label for="first-name-column" class="form-label">Stock</label>
                                                    <input type="number" id="first-name-column" class="form-control"
                                                        placeholder="Ingrese stock de producto" name="stock" required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group mandatory">
                                                    <label for="first-name-column" class="form-label">Categoria</label>
                                                    <div class="form-group">
                                                        <select class="choices form-select" name="categoria" required>
                                                        <option value="">Seleccione una categoria</option>
                                                            <?php if(!empty($categoria)){
                                                               foreach ($categoria as $key => $value) { ?>
                                                                    
                                                                    <option value="<?php echo $value['id'] ?>"><?php echo $value['nombre']; ?></option>
                                                              <?php } ?>
                                                                
                                                            <?php }else{ ?>    
                                                                <option value="">No tiene categorias</option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php foreach ($dato as $key => $data) { ?>
                                            <input type="hidden" name="id_tienda" value="<?php echo $_SESSION['id_tienda']; ?>">
                                        <?php } ?>
                                        <div class="row">
                                            <div class="col-12 d-flex justify-content-end">
                                                <button type="submit" value="btnAddProducto"
                                                    class="btn btn-primary me-1 mb-1">
                                                    Añadir
                                                </button>
                                                <input type="hidden" name="m" value="addProducto">
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
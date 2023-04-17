<?php 
  session_start();
  if(!(isset($_SESSION['nombre']))){

    require_once("../config.php");
    header("location:".urlsite);
  }else{
?>

<title>Editar productos</title>
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
                        <h3>Editar Producto</h3>
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
                                <h4 class="card-title">Editar Producto</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <form class="form needs-validation" action="index.php" method="POST" novalidate>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mandatory">
                                                    <label for="first-name-column" class="form-label">Código</label>
                                                    <input type="hidden" name="id_producto" value="<?php echo $data_producto['id'] ?>">
                                                    <input type="number" id="first-name-column" class="form-control"
                                                        placeholder="Código de producto" value="<?php echo $data_producto['codigo'] ?>" name="codigo" required />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mandatory">
                                                    <label for="first-name-column" class="form-label">Nombre</label>
                                                    <input type="text" id="first-name-column" class="form-control"
                                                        placeholder="Nombre del producto" value="<?php echo $data_producto['nombre'] ?>" name="nombre" required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mandatory">
                                                    <label for="first-name-column" class="form-label">Precio</label>
                                                    <input type="number" id="first-name-column" class="form-control"
                                                        placeholder="Ingrese precio de producto" name="precio" value="<?php echo $data_producto['precio'] ?>"
                                                        required />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mandatory">
                                                    <label for="first-name-column" class="form-label">Stock</label>
                                                    <input type="number" id="first-name-column" class="form-control"
                                                        placeholder="Ingrese stock de producto" value="<?php echo $data_producto['stock'] ?>" name="stock" required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group mandatory">
                                                    <label for="first-name-column" class="form-label">Categoria</label>
                                                    <div class="form-group">
                                                        <select class="choices form-select" name="categoria" value="<?php echo $data_producto['id_categoria'] ?>"  required>
                                                            <?php if(!empty($categoria)){
                                                               foreach ($categoria as $key => $value) { ?>
                                                                    <?php if($value['id']==$data_producto['id_categoria']){ ?>
                                                                        <option selected value="<?php echo $value['id'] ?>"><?php echo $value['nombre']; ?></option>
                                                                    <?php }else{ ?>
                                                                        <option value="<?php echo $value['id'] ?>"><?php echo $value['nombre']; ?></option>                                                            
                                                                    <?php } ?> 
                                                                <?php } ?>
                                                            <?php }else{ ?>    
                                                                <option value="">No tiene categorias</option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                            <input type="hidden" name="id_tienda" value="<?php echo $data_producto['id_tienda']; ?>">
                                        <div class="row">
                                            <div class="col-12 d-flex justify-content-end">
                                                <button type="submit" value="btnAddProducto"
                                                    class="btn btn-primary me-1 mb-1">
                                                    Actualizar
                                                </button>
                                                <input type="hidden" name="m" value="updateProducto">
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
<?php } ?>
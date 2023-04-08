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
        <h3>Tiendas</h3>
      </div>
      <div class="page-content">
        <section class="row">
        <div class="card">
            <div class="card-header d-flex justify-content-end">
                <td>
                    <a href="#" data-function> 
                        <span  data-options='[["m","addTienda"]]' class="badge bg-success">Agregar Nueva Tienda</span>
                    </a>
                </td>
            </div>

            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Activa</th>
                            <th>¿Editar?</th>
                            <th>¿Eliminar?</th>
                            <th>¿Ingresar?</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            echo $dato;
                            if(!empty($dato)):
                                foreach($dato as $key=>$value):
                                    foreach($value as $v):?>
                                    <tr>
                                        <th><?php echo $v['id']?> </th>
                                        <th><?php echo $v['nombre']?></th>
                                        <th><?php echo $v['activa']?></th>
                                        <th><a href="#" data-function ><span  data-options='[["m","editTienda"],["id","<?php echo $v['id']?>"]]' class="badge bg-success">Editar</span></a></th>
                                        <th><a href="#" data-function ><span  data-options='[["m","delTienda"],["id","<?php echo $v['id']?>"]]' class="badge bg-success">Eliiminar</span></a></th>
                                        <th><a href="#" data-function ><span  data-options='[["m","InTienda"],["id","<?php echo $v['id']?>"]]' class="badge bg-success">Ingresar</span></a></th>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <th colspan="6"> No hay registros </td>
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

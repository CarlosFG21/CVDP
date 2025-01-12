<?php

include("layout/header.php");


?>

<title>CVDP | San Diego</title>


<?php

include("layout/nav.php");


?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Producto</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">

                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-12">
                    <!-- general form elements disabled -->
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Visualizar</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <?php
            
                            include("../clases/Producto.php");
                            $producto = new Producto();
              
                            $id = $_REQUEST['id'];
                            $productoArray = $producto->BuscarProducto($id);

                            $categoria = $productoArray->getIdcategoria();
                            $nombre = $productoArray->getNombre();
                            $descripcion = $productoArray->getDescripcion();
                            $cantidad = $productoArray->getCantidad();
                            $pcompra = $productoArray->getPcompra();
                            $pventa = $productoArray->getPventa();
                            $ubicacion = $productoArray->getUbicacion();
                            $estado = $productoArray->getEstado();
 
                            if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'existe'){
                          ?>
                          <div class="alert alert-danger alert-dismissible col-sm-6">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-exclamation-triangle"></i> Alerta!</h5>!El Producto a editar ya existe.!
                          </div>
                          <?php
                            }
                          ?>
                          <form  role="form" method="post" action="">
                            <div class="row">
                              <div class="col-sm-6">
                                <div class="form-group">
                                  <label>ID</label>
                                  <?php echo "<input type='number' class='form-control' readonly value='$id'>";?>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-group">
                                  <label>Categoria</label>
                                  <?php echo "<input type='text' class='form-control' readonly value='$categoria'>";?>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-group">
                                  <label>Producto</label>
                                  <?php echo "<input type='text' class='form-control' value='$nombre'readonly>";?>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-group">
                                  <label>Descripcion</label>
                                  <?php echo "<input type='text' class='form-control' value='$descripcion' readonly>";?>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-group">
                                  <label>Cantidad</label>
                                  <?php echo "<input type='number' class='form-control' value='$cantidad' readonly>";?>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-group">
                                  <label>Precio</label>
                                  <?php echo "<input type='text' class='form-control' value='$pcompra'readonly>";?>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-group">
                                  <label>Precio</label>
                                  <?php echo "<input type='text' class='form-control' value='$pventa'readonly>";?>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-group">
                                  <label>Ubicacion</label>
                                  <?php echo "<input type='text' class='form-control' value='$ubicacion'readonly>";?>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-group">
                                  <label>Estado</label>
                                  <?php if ($estado==1) {
                                    $estado="Activo";
                                    }else {
                                      $estado="Inactivo";
                                    }
                                    echo "<input type='text' class='form-control' readonly value='$estado' name='estado' id='estado'>";
                                  ?>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-group">
                                  <label>-</label>
                                  <a type="submit" class="btn btn-danger form-control" href="producto.php">Regresar</a>
                                </div>
                              </div>
                            </div>
                          </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <!-- general form elements disabled -->

                    <!-- /.card -->
                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>


<?php

include("layout/footer.php");


?>
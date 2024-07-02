<?php
  include("layout/header.php");
  include("../db/conexion.php");
  include("../clases/Compra.php");
  include("../clases/DetalleC.php");
  $conexion = new conexion();
  $conexion->conectar();
  $compra = new Compra();
  $detallec = new DetalleC();
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
                    <h1>Visualización de Compras</h1>
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
              
                            $id = $_REQUEST['id'];
                            $compraArray = $compra->BuscarCompra($conexion, $id);

                              $usuario = $compraArray->getIdusuario();
                              $proveedor = $compraArray->getIdproveedor();
                              $tipo_compro = $compraArray->getTipo();
                              $no_compro = $compraArray->getComprobante();
                              $serie_compro = $compraArray->getSerie();
                              $fecha = $compraArray->getFecha();
                              $impuesto = $compraArray->getImpuesto();
                              $total = $compraArray->getTotal();
                              $estado = $compraArray->getEstado();

 
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
                                  <label>Usuario</label>
                                  <?php echo "<input type='text' class='form-control' readonly value='$usuario'>";?>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-group">
                                  <label>Proveedor</label>
                                  <?php echo "<input type='text' class='form-control' value='$proveedor'readonly>";?>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-group">
                                  <label>Tipo Comprobante</label>
                                  <?php echo "<input type='text' class='form-control' value='$tipo_compro' readonly>";?>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-group">
                                  <label>No Comprobante</label>
                                  <?php echo "<input type='number' class='form-control' value='$no_compro' readonly>";?>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-group">
                                  <label>Serie Comprobante</label>
                                  <?php echo "<input type='text' class='form-control' value='$serie_compro'readonly>";?>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-group">
                                  <label>Fecha</label>
                                  <?php echo "<input type='text' class='form-control' value='$fecha'readonly>";?>
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
                                    echo "<input type='text' class='form-control' readonly value='$estado'>";
                                  ?>
                                </div>
                              </div>
                            </div>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                      <th>Producto</th>
                                      <th>Cantidad</th>
                                      <th>Unidad Medida</th>
                                      <th>Precio</th>
                                      <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    $detalleArray = $detallec->BuscarDetalleCompra($conexion, $id);

                                    for($i=0; $i<sizeof($detalleArray); $i++){
                                        
                                      $producto = $detalleArray[$i]->getIdproducto();
                                      $cantidad = $detalleArray[$i]->getCantidad();
                                      $umedida = $detalleArray[$i]->getUnidadm();
                                      $precio = $detalleArray[$i]->getPrecio();
                                      $estado = $detalleArray[$i]->getEstado();
                                      
                                      echo "<tr>
                                        <td>$producto</td>
                                        <td>$cantidad</td>
                                        <td>$umedida</td>
                                        <td>$precio</td>";

                                        if($estado==1){
                                          echo "<td><h4><span class='badge bg-success'>Activo</span></h4></td>";
                                        }else{
                                          echo "<td><h4><span class='badge bg-danger'>Inactivo</span></h4></td>";
                                        }
                                      echo "</tr>";
                                    }
                                  ?>
                                </tbody>
                                <tfoot>
                                  <tr>
                                    <td colspan="3" align="right">Total:</td>
                                    <td id="total"><?php echo $total; ?></td>
                                    <td></td>
                                  </tr>
                                </tfoot>
                            </table>
                            <div class="">
                              <a type="submit" class="btn btn-danger" href="compra.php">Regresar</a>
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
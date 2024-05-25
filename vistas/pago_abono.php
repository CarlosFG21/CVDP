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
            <h1>Pago o Abonar a deuda del cliente</h1>
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
                <h3 class="card-title">Informacion del pago o abono</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <?php
            
                include("../clases/DetalleCuentaC.php");
                $cuentaC = new CuentaC;
              
                $id = $_REQUEST['id'];
                $cuentacArray = $cuentaC->obtenerCuentasPorCobrar($id);
               
                $idcuentac = $cuentacArray->getIdcobrar();
                $idcliente = $cuentacArray->getIdcliente();
                $idventa = $cuentacArray->getIdventa();
                $deudac = $cuentacArray->getDeuda();
                    $cliente = new Persona();
                    $clienteArray = $cliente->BuscarPersona($idcliente);
                    $nombre_cliente = $clienteArray->getNombre();
              
              ?>
                <form role="form" method="post" action="../crud/detallepago.php">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Código de credito</label>
                        <?php echo "<input type='number' class='form-control' readonly value='$id' name='id_cobrar' id='id_cobrar'>";?>
                        <input type="number" name="id_cobrarc" id="id_cobrarc" class="form-control" value="<?php echo $id; ?>" hidden>
                        <input type="number" name="id_usuario" id="id_usuario" class="form-control" value="<?php echo $_SESSION["id"]; ?>" hidden>
                        <input type="number" name="id_venta" id="id_venta" class="form-control" value="<?php echo $idventa; ?>" hidden>
                      </div>
                    </div>
                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Nombre del cliente</label>
                        <?php echo "<input type='text' class='form-control' value='$nombre_cliente' name='nombre' id='nombre'
                        required minlength='3' maxlength='60'>";?>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Deuda</label>
                        <?php echo "<input type='text' class='form-control' value='$deudac' name='deuda_a' id='deuda_a' required minlength='3' maxlength='60'>";?>
                        <input type="number" name="deuda" id="deuda" class="form-control" value="<?php echo $deudac; ?>" hidden>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Pago a realizar</label>
                        <input type="number" step="any" class="form-control" placeholder="Cantidad del pago o abono" name="pago" id="pago">
                      </div>
                    </div>
                    <script>
                      document.addEventListener("DOMContentLoaded", function() {
                      var cantidadInput = document.getElementById('pago');
                      var cantidadDisponibleInput = document.getElementById('deuda_a');

                      cantidadInput.addEventListener('input', function() {
                      var cantidad = parseFloat(cantidadInput.value); // Utilizar parseFloat en lugar de parseInt
                      var cantidadDisponible = parseFloat(cantidadDisponibleInput.value); // Utilizar parseFloat en lugar de parseInt

                          if (cantidad > cantidadDisponible) {
                            alert('La cantidad ingresada es mayor que la deuda');
                            cantidadInput.value = cantidadDisponible; // Restablecer la cantidad al máximo disponible
                          }
                        });
                      });
                    </script>
                    
                    
                    </div> 
                  <div class="">
                  <input type="submit" value="Guardar" class="btn btn-primary " name="btnGuardarDetallepago" id="btnGuardarDetallepago">
                  <a type="submit" class="btn btn-danger" href="cuenta_por_cobrar.php">Regresar</a>
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
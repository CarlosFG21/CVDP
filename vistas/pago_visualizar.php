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
            <h1>Planilla/Pagos</h1>
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
            
            include("../clases/Planilla.php");
            $planilla = new Planilla();
            
            $id = $_REQUEST['id'];

            $plaArray = $planilla->BuscarPago($id);

            $nombre = $plaArray->getNombre();
            $apellido = $plaArray->getApellido();
            $completo = $nombre. " " .$apellido;
            $salario = $plaArray->getSalario();
            $tipo = $plaArray->getTipo();
            $cantidad = $plaArray->getCantidad();
            $mes = $plaArray->getMes();
            $anio = $plaArray->getAnio();
            $estado = $plaArray->getEstado();
            $total = $salario + $cantidad;

             ?>
                <form role="form" method="post" action="">
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Empleado</label>
                        <?php
                         echo "
                        <input type='text' class='form-control' placeholder='Empleado' value='$completo' name='Empleado' id='Empleado'
                        pattern='^[a-zA-Záéíóú0-9]{1,30}' disabled required minlength='3' maxlength='15'>";
                        ?>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Salario</label>
                        <?php
                         echo "
                        <input type='text' class='form-control' placeholder='Salario' value='$salario' name='salario' id='salario'
                        pattern='^[a-zA-Záéíóú0-9]{1,30}' disabled required minlength='3' maxlength='15'>";
                        ?>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Mes</label>
                        <?php
                         echo "
                        <input type='text' class='form-control' placeholder='Mes' value='$mes' name='mes' id='mes'
                        pattern='^[a-zA-Záéíóú0-9]{1,30}' disabled required minlength='3' maxlength='15'>";
                        ?>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Año</label>
                        <?php
                         echo "
                        <input type='text' class='form-control' placeholder='Año' value='$anio' name='anio' id='anio'
                        pattern='^[a-zA-Záéíóú0-9]{1,30}' disabled required minlength='3' maxlength='15'>";
                        ?>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Pago adicional</label>
                        <?php
                         echo "
                        <input type='text' class='form-control' placeholder='Tipo de pago' value='$tipo' name='tipo' id='tipo'
                        pattern='^[a-zA-Záéíóú0-9]{1,30}' disabled required minlength='3' maxlength='15'>";
                        ?>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Cantidad adicional pagada</label>
                        <?php
                         echo "
                        <input type='text' class='form-control' placeholder='Cantidad' value='$cantidad' name='cantidad' id='cantidad'
                        pattern='^[a-zA-Záéíóú0-9]{1,30}' disabled required minlength='3' maxlength='15'>";
                        ?>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Total Pagado</label>
                        <?php
                         echo "
                        <input type='text' class='form-control' placeholder='Total' value='$total' name='total' id='total'
                        pattern='^[a-zA-Záéíóú0-9]{1,30}' disabled required minlength='3' maxlength='15'>";
                        ?>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Estado</label>
                        <?php
                        if($estado==1){
                         echo "
                        <input type='text' class='form-control' placeholder='Pago' value='Pagado' name='pago' id='pago'
                        pattern='^[a-zA-Záéíóú0-9]{1,30}' disabled required minlength='3' maxlength='15'>";
                    }
                        ?>
                      </div>
                    </div>
                    </div> 
                  <div class="">
                  <a type="submit" class="btn btn-danger" href="planilla.php">Regresar</a>
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
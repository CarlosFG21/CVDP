<?php

include("layout/header.php");

?>

<title>CVDP|San Diego </title>

<?php

include("layout/nav.php");

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Gastos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
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
                <h3 class="card-title">Editar</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

              <?php
            
            include("../clases/Gasto.php");
            $gasto = new Gasto();
            
            $id = $_REQUEST['id'];

            $gastoArray = $gasto->BuscarGasto($id);

            $nombre =  $gastoArray->getNombre();
            $apellido =  $gastoArray->getApellido();
            $completo = $nombre. " " .$apellido;
            $tipo = $gastoArray->getTipo();
            $descripcion = $gastoArray->getDescriocion();
            $fecha = $gastoArray->getFecha();
            $monto = $gastoArray->getMonto();
            $estado = $gastoArray->getEstado();

             ?>
            
                <form role="form" method="post" action="../crud/gastoeditar.php?id=<?php echo $id;?>">
                  <div class="row">
                  <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Empleado</label>
                        <?php
                        echo "
                        <input type='text' class='form-control' placeholder='tipo' value='$completo' name='' id=''
                        pattern='^[a-zA-Záéíóú0-9]{1,30}' disabled required minlength='3' maxlength='15'>";
                        ?>
                       
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Tipo de gasto</label>
                        <?php
                         echo "
                        <input type='text' class='form-control' placeholder='tipo' value='$tipo' name='tipo' id='tipo'
                        pattern='^[a-zA-Záéíóú0-9]{1,30}' required minlength='3' maxlength='15'>";
                        ?>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Descripción</label>
                        <?php
                         echo "
                        <input type='text' class='form-control' placeholder='descripcion' value='$descripcion' name='descripcion' id='descripcion'
                        pattern='^[a-zA-Záéíóú0-9 ]{1,30}'  required minlength='3' maxlength='15'>";
                        ?>
                      </div>
                    </div>
                    
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Fecha del gasto</label>
                        <?php
                         echo "
                        <input type='date' class='form-control' placeholder='Fecha' value='$fecha' name='fecha' id='fecha'
                        pattern='^[a-zA-Záéíóú0-9]{1,30}'  required minlength='3' maxlength='15'>";
                        ?>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Monto gastado</label>
                        <?php
                         echo "
                        <input type='number' class='form-control' placeholder='Rol' value='$monto' name='monto' id='monto'
                        pattern='^[a-zA-Záéíóú0-9]{1,30}' required minlength='3' maxlength='15'>";
                        ?>
                      </div>
                    </div> 
                    </div> 
                  <div class="">
                  <input type="submit" value="Guardar" class="btn btn-primary " name="btnEditarGasto" id="btnEditarGasto">
                  <a type="submit" class="btn btn-danger" href="gasto.php">Regresar</a>
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

include('layout/footer.php');

?>

<script type="text/javascript">
$(function() {
    $('#btnEditarGasto').click(function() {

        var valid = this.form.checkValidity();
        if (valid) {
          return confirm('!Desea guardar los datos');
   
        } 

    });

});
</script>
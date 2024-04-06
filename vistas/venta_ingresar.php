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
            <h1>Venta</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

  <section class="content">
  <div class="row">

  <div class="col-lg-5 col-xs-12">
      <div class="box box-success">
      <div class="box-header with-border"></div>

      <!--=====================================
      EL FORMULARIO
      ======================================-->
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Ingresar</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
             <!-- <div class="form-group">
              <h4>Datos Laborales</h4>
              </div> -->
              <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'existe'){
              ?>
               <div class="alert alert-danger alert-dismissible col-sm-6">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-exclamation-triangle"></i> Alerta!</h5>
                  !Exite venta ingresar ya existe.!
                </div>
              <?php
                }
              ?>
              <!-- /.Validacion codigo php -->
                <form role="form" method="post" action="../crud/ventaingresar.php">
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Nombre Cliente</label>
                        <input type="text" class="form-control" placeholder="Nombre" minlength="3" maxlength="25" required name="nombre" id="nombre" pattern="^[a-zA-Záéíóú ]{1,30}">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Tipo de Comprobante</label>
                        <input type="text" class="form-control" placeholder="Apellido" minlength="3" maxlength="25" required name="apellido" id="apellido" pattern="^[a-zA-Záéíóú ]{1,30}">
                      </div>
                    </div>
 
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Pago</label>
                        <input type="number" class="form-control" placeholder="id_usuario" minlength="3" maxlength="25" required name="id_usuario" id="id_usuario" pattern="^[a-zA-Záéíóú ]{1,30}">
                      </div>
                    </div>

                    
                  </div>
                  <div class="">
                  <input type="submit" value="Guardar" class="btn btn-primary" name="btnGuardarEmpleado" id="btnGuardarEmpleado">
                  <a type="submit" class="btn btn-danger" href="empleado.php">Regresar</a>
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

      </div>
  </div>

  <div class="col-lg-7 hidden-md hidden-sm hidden-xs">
        
        <div class="box box-warning">

          <div class="box-header with-border"></div>

          <div class="box-body">
            
            <table class="table table-bordered table-striped dt-responsive tablaVentas">
              
               <thead>

                 <tr>
                  <th style="width: 10px">#</th>
                  <th>Código</th>
                  <th>Descripcion</th>
                  <th>Stock</th>
                  <th>Acciones</th>
                </tr>

              </thead>

            </table>

          </div>

        </div>


      </div>
  
   
  </section>

</div>



<?php  

include('layout/footer.php');

?>

<script type="text/javascript">
$(function() {
    $('#btnGuardarEmpleado').click(function() {

        var valid = this.form.checkValidity();
        if (valid) {
          return confirm('!Desea guardar los datos');
   
        } else {
            alert('Debe de rellenar los campos o coincidir con el formato indicado');
        }

        var nombre = $('#nombre').val();
        var apellido = $('#apellido').val();
        var edad = $('#edad').val();
        var puesto = $('#puesto').val();
        var salario = $('#salario').val();
        var fecha_ent = $('#fecha_ent').val();
        var id_usuario = $('#id_usuario').val();

    });

});
</script>
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
            <h1>Empleado</h1>
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
                  !El empleado a ingresar ya existe.!
                </div>
              <?php
                }
              ?>
              <!-- /.Validacion codigo php -->
                <form role="form" method="post" action="../crud/empleadoingresar.php">
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" class="form-control" placeholder="Nombre" minlength="3" maxlength="25" required name="nombre" id="nombre" pattern="^[a-zA-Záéíóú ]{1,30}">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Apellido</label>
                        <input type="text" class="form-control" placeholder="Apellido" minlength="3" maxlength="25" required name="apellido" id="apellido" pattern="^[a-zA-Záéíóú ]{1,30}">
                      </div>
                    </div>
                    
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Edad</label>
                        <input type="number" class="form-control" placeholder="Edad" minlength="18" maxlength="120" required name="edad" id="edad" pattern="^[a-zA-Záéíóú ]{1,30}">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Puesto</label>
                        <select type="text"class="form-control" name="puesto" id="puesto">
                          <option>Gerente</option>
                          <option>Administrador</option>
                          <option>Cajero</option>
                          <option>Empleado</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Salario</label>
                        <input type="number" class="form-control" placeholder="Salario" minlength="3" maxlength="25" required name="salario" id="salario" pattern="^[a-zA-Záéíóú ]{1,30}">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Fecha de Entrada</label>
                        <input type="date" class="form-control" placeholder="Fecha_ent" required name="fecha_ent" id="fecha_ent" pattern="^[a-zA-Záéíóú ]{1,30}">
                      </div>
                    </div>
                    
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Usuario</label>
                        <input type="number" class="form-control" placeholder="id_usuario" minlength="3" maxlength="25" required name="id_usuario" id="id_usuario" pattern="^[a-zA-Záéíóú ]{1,30}">
                      </div>
                    </div>

                  
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Estado</label>
                        <select type="number"class="form-control" name="estado" id="estado">
                          <option value="1">Activo</option>
                        </select>
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
    </section>
    <!-- /.content -->
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
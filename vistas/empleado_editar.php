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
                <h3 class="card-title">Editar</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <?php
            
            include("../clases/Empleado.php");
            $empleado = new Empleado();
            
            $id = $_REQUEST['id'];

            $empleadoArray = $empleado->BuscarEmpleado($id);

            $nombre = $empleadoArray->getNombre();
            $apellido = $empleadoArray->getApellido();
            $edad = $empleadoArray->getEdad();
            $puesto = $empleadoArray->getPuesto();
            $salario = $empleadoArray->getSalario();
            $fecha_ent = $empleadoArray->getFecha();
            $idusuario = $empleadoArray->getIdusuario();

             ?>
              <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'existe'){
              ?>
               <div class="alert alert-danger alert-dismissible col-sm-6">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-exclamation-triangle"></i> Alerta!</h5>
                  !El Empleado a ingresar ya existe.!
                </div>
              <?php
                }
              ?>
              <!-- /.Validacion codigo php -->
                <form role="form" method="post" action="../crud/empleadoeditar.php?id=<?php echo $id;?>">
                  <div class="row">
                    
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Nombre</label>
                        <?php
                         echo "
                        <input type='text' class='form-control' placeholder='Nombre' value='$nombre' name='nombre' id='nombre'
                        pattern='^[a-zA-Záéíóú ]{1,30}' required minlength='3' maxlength='15'>";
                        ?>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Apellido</label>
                        <?php
                         echo "
                        <input type='text' class='form-control' placeholder='Apellido' value='$apellido' name='apellido' id='apellido'
                        pattern='^[a-zA-Záéíóú ]{1,30}' required minlength='3' maxlength='15'>";
                        ?>
                      </div>
                    </div>
                  
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>edad</label>
                        <?php
                         echo "
                        <input type='number' class='form-control' placeholder='Edad' value='$edad' name='edad' id='edad'
                        pattern='^[0-9]{1,30}' required minlength='9' maxlength='9'>";
                        ?>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Puesto</label>
                        <select type="text"class="form-control" name="puesto" id="puesto">
                          <?php echo "<option> $puesto</option>";?>
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
                        <?php
                         echo "
                        <input type='number' class='form-control' placeholder='Salario' value='$salario' name='salario' id='salario'
                        pattern='^[0-9]{1,30}' required minlength='9' maxlength='9'>";
                        ?>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Fecha de Entrada</label>
                        <?php
                         echo "
                        <input type='date' class='form-control' placeholder='Fecha_ent' value='$fecha_ent' name='fecha_ent' id='fecha_ent'
                        pattern='^[a-zA-Záéíóú ]{1,30}' required minlength='3' maxlength='15'>";
                        ?>
                      </div>
                    </div>

                  </div>
                  
                  <div class="">
                  <input type="submit" value="Guardar" class="btn btn-primary" name="btnEditarEmpleado" id="btnEditarEmpleado">
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
    $('#btnEditarEmpleado').click(function() {

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
        var fecha_ent = $('#fecha_emt').val();

    });

});
</script>
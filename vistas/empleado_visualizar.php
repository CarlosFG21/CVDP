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
                <h3 class="card-title">Visualizar</h3>
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

             ?>
              <!-- /.Validacion codigo php -->
                <form role="form" method="post" action="">
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Nombre</label>
                        <?php
                         echo "
                        <input type='text' class='form-control' placeholder='Nombre' value='$nombre' name='nombre' id='nombre'
                        pattern='^[a-zA-Záéíóú ]{1,30}' required disabled minlength='3' maxlength='15'>";
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
                        pattern='^[a-zA-Záéíóú ]{1,30}' required disabled minlength='3' maxlength='15'>";
                        ?>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Edad</label>
                        <?php
                         echo "
                        <input type='number' class='form-control' placeholder='Edad' value='$edad' name='edad' id='edad'
                        pattern='^[0-9]{1,30}' required disabled minlength='9' maxlength='9'>";
                        ?>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Puesto</label>
                        <?php
                         echo "
                        <input type='text' class='form-control' placeholder='Puesto' value='$puesto' name='puesto' id='puesto'
                        pattern='^[0-9]{1,30}' required disabled minlength='9' maxlength='9'>";
                        ?>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Salario</label>
                        <?php
                         echo "
                        <input type='number' class='form-control' placeholder='Salario' value='$salario' name='salario' id='salario'
                        pattern='^[0-9]{1,30}' required disabled minlength='9' maxlength='9'>";
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
                        pattern='^[0-9]{1,30}' required disabled minlength='9' maxlength='9'>";
                        ?>
                      </div>
                    </div>
                  </div>  
                  <div class="">
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
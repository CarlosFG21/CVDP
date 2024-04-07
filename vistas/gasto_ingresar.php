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
                <h3 class="card-title">Ingresar</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
             <!-- <div class="form-group">
              <h4>Datos Laborales</h4>
              </div> -->
              <!-- /.Validacion codigo php -->
                <form role="form" method="post" action="../crud/gastoingresar.php">
                  <div class="row">
                  <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Selecione un empleado</label>
                        <select type="text"class="form-control" name="empleado" id="empleado">
                        <?php
                        include("../clases/Empleado.php");
                        $empleadoob = new Empleado();
                        $empleadoArray = $empleadoob->ObtenerEmpleadosActivo();
      
                        for($i=0; $i<sizeof($empleadoArray); $i++){
                         
                          $id = $empleadoArray[$i]->getIdEmpleado();
                          $nombre = $empleadoArray[$i]->getNombre();
                          $apellido = $empleadoArray[$i]->getApellido();

                          echo "<option value='$id'>"."". $nombre . " " . $apellido . "". "</option>";

                        }
                        ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Tipo de gasto</label>
                        <input type="text" class="form-control" placeholder="Tipo de gasto" minlength="3" maxlength="30" required name="gasto" id="gasto" pattern="^[a-zA-Záéíóú0-9 ]{1,30}">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Descripción</label>
                        <input type="text" class="form-control" placeholder="Descripción" minlength="3" maxlength="35" required name="descripcion" id="descripcion" pattern="^[a-zA-Záéíóú0-9 ]{1,30}">
                      </div>
                    </div>
                    
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Fecha del gasto</label>
                        <input type="date" class="form-control" placeholder="Fecha" minlength="18" maxlength="120" required name="fecha" id="fecha" pattern="^[a-zA-Záéíóú ]{1,30}">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Monto gastado</label>
                        <input type="number" class="form-control" placeholder="Monto gastado" minlength="3" maxlength="25" required name="monto" id="monto" pattern="^[0-9 ]{1,30}">
                      </div>
                    </div> 
                    </div> 
                  <div class="">
                  <input type="submit" value="Guardar" class="btn btn-primary" name="btnGuardarGasto" id="btnGuardarGasto">
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
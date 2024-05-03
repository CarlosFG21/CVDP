
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
            <h1>Planilla/Pagos</h1>
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
               <div class="alert alert-danger alert-dismissible col-sm-4">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-exclamation-triangle"></i> Alerta!</h5>
                  !La planilla y el pago generado del empleado ya existe.!
                </div>
              <?php
                }
              ?>
              <form role="form" method="POST" action="../crud/planillaingresar.php" id="formdata">
                  <div class="row">
                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Seleccione un empleado</label>
                        <select class="form-control" name="lista1" id="lista1">

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
                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                      <label>Seleccione mes de planilla a pagar</label>
                      <select class="form-control" name="mes" id="mes">
                        <option value="Enero">Enero</option>
                        <option value="Febrero">Febrero</option>
                        <option value="Marzo">Marzo</option>
                        <option value="Abril">Abril</option>
                        <option value="Mayo">Mayo</option>
                        <option value="Junio">Junio</option>
                        <option value="Julio">Julio</option>
                        <option value="Agosto">Agosto</option>
                        <option value="Septiembre">Septiembre</option>
                        <option value="Octubre">Octubre</option>
                        <option value="Noviembre">Noviembre</option>
                        <option value="Diciembre">Diciembre</option>
                      </select>
                      </div>
                    </div>
                    <?php
                    $Date = date("d-m-Y");  
                    $year = date("Y");


                    echo "<div class='col-sm-4'>
                    
                    <div class='form-group'>
                      <label>Seleccione año de planilla a pagar</label>
                      <select class='form-control' name='anio' id='anio'>";
                      
      
                        for($i=$year;$i>=1990;$i--) { 
                          echo "<option value='".$i."'>".$i."</option>";
                        }
                        
                    echo "</select>";
                    echo "</div>";
                    echo "</div>";


                   ?>
                  <div id="select2lista" class="row"> 
                  <!--Aquí se recargan los datos del cliente-->                              
                </div>
                 <div id="prueba">
                </div>
                <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                      <label>Seleccione un tipo de pago</label>
                      <select class="form-control" name="tipo" id="tipo">
                      <option value="Null" disabled="disabled" selected>Seleccione un tipo de pago</option>
                        <option value="Bona 14">Bono 14</option>
                        <option value="Aguinaldo">Aguinaldo</option>
                        <option value="Bono-Venta">Bono-Venta</option>
                        <option value="Otro">Otro</option>
                      </select>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Cantidad pagada</label>
                        <input type="number" class="form-control" placeholder="Cantidad" minlength="2" maxlength="10" name="cantidad" id="cantidad" pattern="^[0-9]{1,30}">
                      </div>
                    </div>
                </div> 
                
                <div class="">
                <input type="submit" value="Guardar" class="btn btn-primary" name="btnGuardarPlanilla" id="btnGuardarPlanilla">
                <a type="submit" class="btn btn-danger" href="planilla.php">Regresar</a>
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

<script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()

      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
    });
</script>

<script type="text/javascript">

function recargarLista(){
    
    //------------Para cargar los datos del empleado seleccionado
    $.ajax({
        type:"POST",
        url:"cargarplanilla_empleado.php?id=" + $ ('#lista1').val() ,
        data:$("#form").serialize(),
        success:function(r){
            $('#select2lista').html(r);
        }
    
    });

}

</script>

<script type="text/javascript">
$(document).ready(function(){

    //recargarLista();

    $('#lista1').change(function(){
     recargarLista();
    });

});
</script>

<script type="text/javascript">
$(function() {
    $('#btnGuardarPlanilla').click(function() {

        var valid = this.form.checkValidity();
        if (valid) {
          return confirm('!Desea guardar los datos');
   
        } 

    });

});
</script>

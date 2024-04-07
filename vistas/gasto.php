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
          <div class="col-12">
          
            <div class="card">
              <div class="card-header">
              <a type="submit" class="btn btn-success" href="gasto_ingresar.php"> <i class="nav-icon fas fa-plus">Ingresar gasto</i></a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Empleado</th>
                    <th>Tipo de gasto</th>
                    <th>Descripción</th>
                    <th>Fecha</th>
                    <th>Monto</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  include("../clases/Gasto.php");
                  $gasto = new Gasto();
                  $gastoArray = $gasto->ObtenerGastos();

                  for($i=0; $i<sizeof($gastoArray); $i++){
                   
                    
                    $nombre =  $gastoArray[$i]->getNombre();
                    $apellido =  $gastoArray[$i]->getApellido();
                    $completo = $nombre. " " .$apellido;
                    $id = $gastoArray[$i]->getIdgasto();
                    $tipo = $gastoArray[$i]->getTipo();
                    $descripcion = $gastoArray[$i]->getDescriocion();
                    $fecha = $gastoArray[$i]->getFecha();
                    $monto = $gastoArray[$i]->getMonto();
                    $estado = $gastoArray[$i]->getEstado();

                    echo "<tr>";
                         
                    echo "<td>$id</td>
                         <td>$completo</td>
                         <td>$tipo</td>
                         <td>$descripcion</td>
                         <td>$fecha</td>
                         <td>$monto</td>
                    
                              
                    ";

                    if($estado==1){
                     echo "<td><h4><span class='badge bg-success'>Ingresado</span></h4></td>";
                    }
                    echo "<td>
                 <a type='submit' href='' title='Editar' class='btn btn-warning'>
                 <i class='fa fa-edit'></i>
                 </a> &nbsp;&nbsp;"; 

               
                   echo"<a type='submit' class='btn btn-primary' title='Visualizar' id='' href='gasto_visualizar.php?id=$id'>
                   <i class='fas fa-eye'></i>
                   </a>&nbsp;&nbsp;"; 
                   
                 


                    echo "</tr>";

               }
               
             ?>     
                  </tbody>
                  <tfoot>
                  <tr>
                  <th>ID</th>
                    <th>Empleado</th>
                    <th>Tipo de gasto</th>
                    <th>Descripción</th>
                    <th>Fecha</th>
                    <th>Monto</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>


<?php

include("layout/footer.php");


?>
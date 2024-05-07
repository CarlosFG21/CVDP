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
          <div class="col-12">
          
            <div class="card">
              <div class="card-header">
              <a type="submit" class="btn btn-success" href="planilla_ingresar.php"> <i class="nav-icon fas fa-plus">Ingresar planilla</i></a>
              <a type="submit" class="btn btn-danger" target="_blank" href="../reportes/reporte_planilla.php"> <i class="nav-icon fas fa-file"> Generar Reporte</i></a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Salario</th>
                    <th>Mes</th>
                    <th>Año</th>
                    <th>Pago ad.</th>
                    <th>Cantidad</th>
                    <th>Total pagado</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  include("../clases/Planilla.php");
                  $planilla = new Planilla();
                  $plaArray = $planilla->ObtenerPlanillaPago();

                  for($i=0; $i<sizeof($plaArray); $i++){
                   
                    $id = $plaArray[$i]->getIdplanilla();
                    $nombre = $plaArray[$i]->getNombre();
                    $apellido = $plaArray[$i]->getApellido();
                    $completo = $nombre. " " .$apellido;
                    $salario = $plaArray[$i]->getSalario();
                    $tipo = $plaArray[$i]->getTipo();
                    $cantidad = $plaArray[$i]->getCantidad();
                    $mes = $plaArray[$i]->getMes();
                    $anio = $plaArray[$i]->getAnio();
                    $estado = $plaArray[$i]->getEstado();
                    $total = $salario + $cantidad;

                    echo "<tr>";
                         
                    echo "<td>$id</td>
                         <td>$completo</td>
                         <td>$salario</td>
                         <td>$mes</td>
                         <td>$anio</td>  
                                
                    
                    ";

                    if($tipo == null){
                      echo "<td><p>Ninguno</p></td>";
                     }else{
                      echo "<td>$tipo</td>";
                     }

                     echo "<td>$cantidad</td>";
                     echo "<td>$total</td>";

                    if($estado==1){
                     echo "<td><h4><span class='badge bg-success'>Pagado</span></h4></td>";
                    }
                    echo "<td>
                 <a type='submit' href='pago_visualizar.php?id=$id' title='Editar' class='btn btn-primary'>
                 <i class='fas fa-eye'></i>
                 </a> &nbsp;&nbsp;"; 

                 if($estado==1){
                   echo"<a type='submit' class='btn btn-danger' title='Eliminar' id='btnEliminarPago' href='../crud/eliminarpago.php?id=$id'>
                   <i class='fas fa-window-close'></i>
                   </a>&nbsp;&nbsp;"; 
                   }
                 


                    echo "</tr>";

               }
               
             ?>   
                  </tbody>
                  <tfoot>
                  <tr>
                  <th>ID</th>
                    <th>Nombre</th>
                    <th>Salario</th>
                    <th>Mes</th>
                    <th>Año</th>
                    <th>Pago ad.</th>
                    <th>Cantidad</th>
                    <th>Total pagado</th>
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

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
            <h1>Pagos de créditos</h1>
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
              <?php 
              include("../clases/DetalleCuentaC.php");
              
              ?>
              
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>No. Cuenta Cobrar</th>
                    <th>Deuda</th>
                    <th>Fecha Inicio</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                    
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                 
                  $pagoscob = new DetalleCuentaC();
                  $pagoscArray = $pagoscob->ObtenerDetalleCuentaC();
                  for($i=0; $i<sizeof($pagoscArray); $i++){
                    $iddetallecuentac = $pagoscArray[$i]->getIdDetallecuentac();
                    $idcuentac = $pagoscArray[$i]->getIdCuentaporcobrarc();
                    $fecha = $pagoscArray[$i]->getFechapago();
                    $cantidadp = $pagoscArray[$i]->getCantidadabonar();
                    $estado = $pagoscArray[$i]->getEstado();

                  
                    echo "<tr>";
                         
                    echo "<td>$iddetallecuentac</td>
                          <td>$idcuentac</td>
                         <td><center>Q. $cantidadp</center></td>
                         <td><center>$fecha</center></td>
                    ";

                    if($estado==1){
                        echo "<td><h4><span class='badge bg-danger'>Pendiente</span></h4></td>";
                    }else{
                     echo "<td><h4><span class='badge bg-success'>Cancelada</span></h4></td>";
                    }
                    
                    echo "<td>
                    <a type='submit' href='../ticket/ticket_pago.php?id=$iddetallecuentac'class='btn bg-gradient-primary' title='Visualizar pago'>
                    <i class='fas fa-eye'></i> 
                    </a>";


                    echo "</tr>";

               }
               
             ?>   
                  </tbody>
                  
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
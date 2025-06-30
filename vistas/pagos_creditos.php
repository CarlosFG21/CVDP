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
              $pagocredID = new CuentaC();
              $id = $pagocredID->ObtenerUltimoIdPagoCredito();
              if($id >= 1){
                echo "<a type='submit' class='btn btn-warning' href='../reportes/Ultimo_pagocredito.php'> <i class='nav-icon fas fa-plus'> Ultimo Pago Realizado</i></a>";
              }
              ?>
              <?php 
              
              
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
                    $pagocred = $pagoscArray[$i]->getCantidadabonar();
                    $pagosal = $pagoscArray[$i]->getSaldop();

                  
                    echo "<tr>";
                         
                    echo "<td>$iddetallecuentac</td>
                          <td>$idcuentac</td>
                         <td><center>Q. $cantidadp</center></td>
                         <td><center>$fecha</center></td>
                    ";

                    if(($pagosal-$pagocred)!= 0){
                        echo "<td><h4><span class='badge bg-warning'>Abono</span></h4></td>";
                    }else{
                     echo "<td><h4><span class='badge bg-success'>Pago Total</span></h4></td>";
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
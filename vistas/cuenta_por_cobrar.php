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
            <h1>Cuentas Por Cobrar / Créditos</h1>
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
              include("../clases/CuentaC.php");
              
              ?>
              
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nombre Cliente</th>
                    <th>No. Venta</th>
                    <th>Deuda</th>
                    <th>Fecha Inicio</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                    
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                 
                  $cuentacob = new CuentaC();
                  $cuentacArray = $cuentacob->ObtenerCuentaC();
                  for($i=0; $i<sizeof($cuentacArray); $i++){

                    $idcobrar = $cuentacArray[$i]->getIdcobrar();
                    $idcliente = $cuentacArray[$i]->getIdcliente();
                    $idventa = $cuentacArray[$i]->getIdventa();
                    $fecha = $cuentacArray[$i]->getFecha();
                    $totaldeuda = $cuentacArray[$i]->getDeuda();
                    $estado = $cuentacArray[$i]->getEstado();
                    $cliente = new Persona();
                    $clienteArray = $cliente->BuscarPersona($idcliente);
                    $nombre_cliente = $clienteArray->getNombre();
                    echo "<tr>";
                         
                    echo "<td>$idcobrar</td>
                         <td>$nombre_cliente</td>
                         <td>$idventa</td>
                         <td><center>Q. $totaldeuda</center></td>
                         <td><center>$fecha</center></td>
                    ";

                    if($estado==1){
                        echo "<td><h4><span class='badge bg-danger'>Pendiente</span></h4></td>";
                    }else{
                     echo "<td><h4><span class='badge bg-success'>Cancelada</span></h4></td>";
                    }
                    
                    echo "<td>
                    <a type='submit' href='../vistas/pago_abono.php?id=$idcobrar' class='btn bg-gradient-primary' title='pago o abono'>
                    <i class='fas fa-credit-card'> Pago/Abono</i> 
                    </a>
                    <a type='submit' href='../ticket/Vista.php?id=$idventa' class='btn bg-gradient-primary' title='Visualizar Venta'>
                    <i class='fas fa-eye'></i> 
                    </a>&nbsp;&nbsp;";


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
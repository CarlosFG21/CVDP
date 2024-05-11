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
            <h1>Venta</h1>
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
              <a type="submit" class="btn btn-success" href="venta_ingresar.php"> <i class="nav-icon fas fa-plus"> Ingresar nueva Venta</i></a>
              <?php 
              include("../clases/DetalleV.php");
              $VentaID = new DetalleV();
              $id = $VentaID->ObtenerUltimoIdVenta();
              if($id >= 1){
                echo "<a type='submit' class='btn btn-warning' href='../reportes/Ultima_Venta.php'> <i class='nav-icon fas fa-plus'> Ultima Venta Realizada</i></a>";
              }
              ?>
              
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nombre Cliente</th>
                    
                    <th>Tipo Comprobante</th>
                    <th>No. Comprobante</th>
                    <th>No. Serie</th>
                    <th>Fecha de Venta</th>
                    <th>Total</th>
                    <th>Metodo de Pago</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                    
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                 
                  $ventaob = new Venta();
                  $ventaArray = $ventaob->ObtenerVenta();
                  for($i=0; $i<sizeof($ventaArray); $i++){

                    $id = $ventaArray[$i]->getIdventa();
                    $idcliente = $ventaArray[$i]->getIdcliente();
                    $idusuario = $ventaArray[$i]->getIdusuario();
                    $tipoc = $ventaArray[$i]->getTipoc();
                    $comprobante = $ventaArray[$i]->getComprobante();
                    $serie = $ventaArray[$i]->getSerie();
                    $fecha = $ventaArray[$i]->getFecha();
                    $total = $ventaArray[$i]->getTotal();
                    $pago = $ventaArray[$i]->getPago();
                    $estado = $ventaArray[$i]->getEstado();
                    $cliente = new Persona();
                    $clienteArray = $cliente->BuscarPersona($idcliente);
                    $nombre_cliente = $clienteArray->getNombre();
                    echo "<tr>";
                         
                    echo "<td>$id</td>
                         <td>$nombre_cliente</td>
                         
                         <td>$tipoc</td>
                         <td>$comprobante</td>
                         <td>$serie</td>
                         <td>$fecha</td>
                         <td>Q. $total</td>
                    ";
                    if($pago==1){
                      echo "<td><h4><span class='badge bg-info'>Efectivo</span></h4></td>";
                     }else{
                      echo "<td><h4><span class='badge bg-warning'>Crédito</span></h4></td>";
                     }

                    if($estado==1){
                     echo "<td><h4><span class='badge bg-success'>Aprobado</span></h4></td>";
                    }else{
                     echo "<td><h4><span class='badge bg-danger'>Cancelada</span></h4></td>";
                    }
                    
                    echo "<td>
                    <a type='submit' href='../ticket/Vista.php?id=$id'class='btn bg-gradient-primary' title='Visualizar Venta'>
                    <i class='fas fa-eye'></i> 
                    </a>&nbsp;&nbsp;";
                 if($estado==1){
                   echo"<a type='submit' class='btn btn-success' title='Eliminar' id='btnEliminarVenta' href='../crud/eliminarventa.php?id=$id'>
                   <i class='fas fa-trash'></i>
                   </a>&nbsp;&nbsp;"; 
                   }else{
                     //Imprimimo botón de reactivar
                     echo"<a type='submit' class='btn btn-danger' id='btnReactivarVenta' href='../crud/reactivarventa.php?id=$id' title='Reactivar'>
                   <i class='fa fa-share-square'></i>
                   </a>&nbsp;&nbsp;"; 
                   }
                   
                   echo "<a type='submit' href='../ticket/ticket.php?id=$id'class='btn bg-gradient-orange' title='ticket'>
                   <i class='fas fa-tag'></i> 
                   </a></td>";


                    echo "</tr>";

               }
               
             ?>   
                  </tbody>
                  <!-- <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Nombre </th>
                    <th>Apellido </th>
                    <th>Edad</th>
                    <th>Puesto</th>
                    <th>Salario</th>
                    <th>Fecha de Entrada</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                  </tr>
                  </tfoot>-->
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
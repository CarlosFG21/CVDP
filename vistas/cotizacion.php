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
            <h1>Cotización</h1>
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
              <a type="submit" class="btn btn-success" href="cotizacion_ingresar.php"> <i class="nav-icon fas fa-plus"> Ingresar nueva Cotización</i></a>
              <?php 
              include("../clases/DetalleCotizacion.php");
              $CotizacionID = new DetalleCotizacion();
              $id = $CotizacionID->ObtenerUltimoIdCotizacion();
              if($id >= 1){
                echo "<a type='submit' class='btn btn-warning' href='../reportes/Ultima_Cotizacion.php'> <i class='nav-icon fas fa-plus'> Ultima Cotización Realizada</i></a>";
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
                    <th>Descripcion</th>
                    <th>Fecha de la Cotización</th>
                    <th>Total</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                    
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  
                  $cotizacionob = new cotizacion();
                  $cotizacionArray = $cotizacionob->ObtenerCotizacion();
                  for($i=0; $i<sizeof($cotizacionArray); $i++){

                    $id = $cotizacionArray[$i]->getIdcotizacion();
                    $idcliente = $cotizacionArray[$i]->getIdcliente();
                    $idusuario = $cotizacionArray[$i]->getIdusuario();
                    $descripcion = $cotizacionArray[$i]->getDescripcion();
                    $fecha = $cotizacionArray[$i]->getFecha();
                    $total = $cotizacionArray[$i]->getTotal();
                    $estado = $cotizacionArray[$i]->getEstado();
                    $cliente = new Persona();
                    $clienteArray = $cliente->BuscarPersona($idcliente);
                    $nombre_cliente = $clienteArray->getNombre();
                    echo "<tr>";
                         
                    echo "<td>$id</td>
                         <td>$nombre_cliente</td>
                         
                         <td>$descripcion</td>
                         <td>$fecha</td>
                         <td>Q. $total</td>
                    ";

                    if($estado==1){
                     echo "<td><h4><span class='badge bg-success'>Aprobado</span></h4></td>";
                    }else{
                     echo "<td><h4><span class='badge bg-danger'>Cancelado</span></h4></td>";
                    }
                    
                    echo "<td>
                    <a type='submit' href='../ticket/Vista_cotizacion.php?id=$id'class='btn bg-gradient-primary' title='Visualizar Venta'>
                    <i class='fas fa-eye'></i> 
                    </a>&nbsp;&nbsp;";
                 if($estado==1){
                   echo"<a type='submit' class='btn btn-success' title='Eliminar' id='btnEliminarVenta' href='../crud/eliminarcotizacion.php?id=$id'>
                   <i class='fas fa-trash'></i>
                   </a>&nbsp;&nbsp;"; 
                   }else{
                     //Imprimimo botón de reactivar
                     echo"<a type='submit' class='btn btn-danger' id='btnReactivarVenta' href='../crud/reactivarcotizacion.php?id=$id' title='Reactivar'>
                   <i class='fa fa-share-square'></i>
                   </a>&nbsp;&nbsp;"; 
                   }


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
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
          <div class="col-12">
          
            <div class="card">
              <div class="card-header">
              <a type="submit" class="btn btn-success" href="empleado_ingresar.php"> <i class="nav-icon fas fa-plus"> Ingresar nuevo empleado</i></a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
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
                  </thead>
                  <tbody>
                  <?php
                  include("../clases/Empleado.php");
                  $empleadoob = new Empleado();
                  $empleadoArray = $empleadoob->ObtenerEmpleados();

                  for($i=0; $i<sizeof($empleadoArray); $i++){
                   
                    $id = $empleadoArray[$i]->getIdEmpleado();
                    $nombre = $empleadoArray[$i]->getNombre();
                    $apellido = $empleadoArray[$i]->getApellido();
                    $edad = $empleadoArray[$i]->getEdad();
                    $puesto = $empleadoArray[$i]->getPuesto();
                    $salario = $empleadoArray[$i]->getSalario();
                    $fecha_ent = $empleadoArray[$i]->getFecha();
                    $estado = $empleadoArray[$i]->getEstado();

                    echo "<tr>";
                         
                    echo "<td>$id</td>
                         <td>$nombre</td>
                         <td>$apellido</td>
                         <td>$edad</td>
                         <td>$puesto</td>
                         <td>$salario</td>
                         <td>$fecha_ent</td>
                    
                    
                    ";

                    if($estado==1){
                     echo "<td><h4><span class='badge bg-success'>Activo</span></h4></td>";
                    }else{
                     echo "<td><h4><span class='badge bg-danger'>Inactivo</span></h4></td>";
                    }
                    
                    echo "<td>
                 <a type='submit' href='empleado_editar.php?id=$id' title='Editar' class='btn btn-warning'>
                 <i class='fa fa-edit'></i>
                 </a> &nbsp;&nbsp;"; 

                 if($estado==1){
                   echo"<a type='submit' class='btn btn-success' title='Eliminar' id='btnEliminarEmpleado' href='../crud/eliminarempleado.php?id=$id'>
                   <i class='fas fa-trash'></i>
                   </a>&nbsp;&nbsp;"; 
                   }else{
                     //Imprimimo botón de reactivar
                     echo"<a type='submit' class='btn btn-danger' id='btnReactivarEmpleado' href='../crud/reactivarempleado.php?id=$id' title='Reactivar'>
                   <i class='fa fa-share-square'></i>
                   </a>&nbsp;&nbsp;"; 
                   }
                   echo "<a type='submit' href='empleado_visualizar.php?id=$id'class='btn bg-gradient-primary' title='Visualizar'>
                   <i class='fas fa-eye'></i> 
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

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
            <h1>Clientes / Proveedores</h1>
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
              <a type="submit" class="btn btn-success" href="persona_ingresar.php"> <i class="nav-icon fas fa-plus"> Ingresar cliente/proveedor</i></a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Tipo</th>
                    <th>Nombre</th>
                    <th>Nit</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  include("../clases/Persona.php");
                  $personaob = new Persona();
                  $personaArray = $personaob->ObtenerPersonas();

                  for($i=0; $i<sizeof($personaArray); $i++){
                   
                    $id = $personaArray[$i]->getIdpersona();
                    $tipo = $personaArray[$i]->getTipo();
                    $nombre = $personaArray[$i]->getNombre();
                    $nit = $personaArray[$i]->getNit();
                    $estado = $personaArray[$i]->getEstado();

                    echo "<tr>";
                         
                    echo "<td>$id</td>
                         <td>$tipo</td>
                         <td>$nombre</td>
                         <td>$nit</td>
                    
                    
                    ";

                    if($estado==1){
                     echo "<td><h4><span class='badge bg-success'>Activo</span></h4></td>";
                    }else{
                     echo "<td><h4><span class='badge bg-danger'>Inactivo</span></h4></td>";
                    }
                    
                    echo "<td>
                 <a type='submit' href='rol_editar.php?id=$id' title='Editar' class='btn btn-warning'>
                 <i class='fa fa-edit'></i>
                 </a> &nbsp;&nbsp;"; 

                 if($estado==1){
                   echo"<a type='submit' class='btn btn-success' title='Eliminar' id='btnEliminarRol' href='../crud/eliminarrol.php?id=$id'>
                   <i class='fas fa-trash'></i>
                   </a>&nbsp;&nbsp;"; 
                   }else{
                     //Imprimimo botón de reactivar
                     echo"<a type='submit' class='btn btn-danger' id='btnReactivarRol' href='../crud/reactivarrol.php?id=$id' title='Reactivar'>
                   <i class='fa fa-share-square'></i>
                   </a>&nbsp;&nbsp;"; 
                   }
                   echo "<a type='submit' href='rol_visualizar.php?id=$id'class='btn bg-gradient-primary' title='Visualizar'>
                   <i class='fas fa-eye'></i> 
                   </a></td>";


                    echo "</tr>";

               }
               
             ?>   
                  </tbody>
                  <tfoot>
                  <tr>
                  <th>ID</th>
                    <th>Tipo</th>
                    <th>Nombre</th>
                    <th>Nit</th>
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

<?php

include("layout/header.php");

?>

<title>CVDP|San Diego </title>

<?php

include("layout/nav.php");
include("../clases/CuentaC.php");


?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Registro de Créditos del cliente</h1>
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
                       <div class="col-md-12">
                           <div class="card card-warning">
                               <div class="card-header">
                                   <h3 class="card-title">Cuentas por cobrar</h3>
                                   <div class="card-tools">
                                       <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                       </button>
                                   </div>

                               </div>
                               <hr>
                               <div class="card-body">
                               <div class="container-fluid" style="font-size: 12px">
                               <div style="display: flex">
                                       <h5>Información de los créditos del cliente</h5>
                                       <div style="width: 20px"></div>
                                       <button type="button" class="btn btn-success" data-toggle="modal"
                                               data-target="#modal-buscar_cliente">
                                           <i class="fa fa-search"></i>
                                           Buscar Cliente
                                       </button>
                                       <!-- modal para visualizar datos de los clientes -->
                                       <div class="modal fade" id="modal-buscar_cliente">
                                           <div class="modal-dialog modal-lg">
                                               <div class="modal-content">
                                                   <div class="modal-header" style="background-color: #EEA200; color: white">
                                                       <h4 class="modal-title">Busqueda de cliente</h4>
                                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                           <span aria-hidden="true">&times;</span>
                                                       </button>
                                                   </div>
                                                   <div class="modal-body">
                                                       <div class="table table-responsive">
                                                           <table id="example1" class="table table-bordered table-striped table-sm">
                                                               <thead>
                                                               <tr>
                                                                   <th><center>No</center></th>
                                                                   <th><center>Nombre del cliente</center></th>
                                                                   <th><center>Nit</center></th>
                                                                   <th><center>Selecionar</center></th>
                                                               </tr>
                                                               </thead>
                                                               <tbody>
                                                               <?php
                                                               $personaob = new Persona();
                                                               $personaArray = $personaob->ObtenerPersonas();
                                             
                                                               for($i=0; $i<sizeof($personaArray); $i++){
                                                                    $id_cliente = $personaArray[$i]->getIdpersona();
                                                                    $nombre_cliente = $personaArray[$i]->getNombre();
                                                                    $nit_cliente = $personaArray[$i]->getNit();
                                                                    //$estado = $personaArray[$i]->getEstado();
                                                                    $tipo = $personaArray[$i]->getTipo();
                                                                
                                                                    if($tipo == "Cliente"){
                                                                ?>  
                                                                   <tr>
                                                                       <td><center><?php echo $id_cliente;?></center></td>
                                                                       <td><?php echo $nombre_cliente;?></td>
                                                                       <td><?php echo $nit_cliente;?></td>
                                                                       <td>
                                                                            <button data-dismiss="modal" class="btn btn-success" id="btn_selecionar_cliente<?php echo $id_cliente;?>">
                                                                               Selecionar
                                                                            </button>
                                                                           <script>
                                                                                var modal = document.getElementById("modal-buscar_cliente");
                                                                                var btn = document.getElementById("btn_selecionar_cliente<?php echo $id_cliente;?>");

                                                                                btn.onclick = function()  {

                                                                                   var id_clientes = '<?php echo $id_cliente; ?>';
                                                                                   document.getElementById("id_cliente").value = id_clientes;

                                                                                   var id_clientes2 = '<?php echo $id_cliente; ?>';
                                                                                   document.getElementById("id_cliente2").value = id_clientes2;

                                                                                   var nombre_clientes = '<?php echo $nombre_cliente;?>';
                                                                                   document.getElementById("nombre_cliente").value = nombre_clientes;

                                                                                   var nit_clientes = '<?php echo $nit_cliente; ?>';
                                                                                   document.getElementById("nit_cliente").value = nit_clientes;
                                                                                    
                                                                                   modal.style.display = "none";    

                                                                               };
                                                                               


                                                                           </script>
                                                                       </td>
                                                                   </tr>
                                                                   <?php
                                                               }    }
                                                               ?>
                                                               </tbody>
                                                           </table>
                                                       </div>
                                                   </div>
                                               </div>
                                               <!-- /.modal-content -->
                                           </div>
                                           <!-- /.modal-dialog -->
                                       </div>
                                       <!-- /.modal -->
                                   </div>
                                </div>

                                   <hr>
                                   <form id="formCuentasPorCobrar" method="post" action="../crud/mostrar_cuentas.php">
                                   <div class="container-fluid" style="font-size: 12px">
                                       <div class="row">
                                                <div class="col-md-4">
                                                   <div class="form-group">
                                                       <label for="">No:</label>
                                                       <input type="number" class="form-control" id="id_cliente2" disabled>
                                                       <input type="number" class="form-control" name="id_cliente" id="id_cliente" hidden>
                                                   </div>
                                               </div>
                                           <div class="col-md-4">
                                               <div class="form-group">
                                                   <label for="">Nombre del cliente </label>
                                                   <input type="text" name="nombre_cliente" id="nombre_cliente" class="form-control" disabled>
                                               </div>
                                           </div>
                                           <div class="col-md-4">
                                               <div class="form-group">
                                                   <label for="">Nit</label>
                                                   <input type="number" name="nit_cliente" id="nit_cliente" class="form-control" disabled>
                                               </div>
                                           </div>
                                                     
                                       </div>     
                                       <div class="col-md-12"><center>
                                                <input type="submit" value="Visualizar creditos del cliente" class="btn btn-primary" name="btnGuardarVenta" id="btnGuardarVenta">
                                                <a type="submit" class="btn btn-danger" href="cuenta_por_cobrar.php">Regresar</a></center>
                                            </div>   
                                   </div>
                                   <hr>
                                   </form>
                                   <?php
                $clienteId = $_GET['cliente_id']; // ID del cliente seleccionado
                  $cuentacob = new CuentaC();
                  $cuentacArray = $cuentacob->ObtenerCuentaC();
                  for($i=0; $i<sizeof($cuentacArray); $i++){
                      $idClienteCuenta = $cuentacArray[$i]->getIdcliente();
                      // Comprueba si el ID del cliente de la cuenta coincide con el ID del cliente seleccionado
                    if ($idClienteCuenta == $clienteId) {

                    $id = $cuentacArray[$i]->getIdcobrar();
                    $idcliente = $cuentacArray[$i]->getIdcliente();
                    $idventa = $cuentacArray[$i]->getIdventa();
                    $fecha = $cuentacArray[$i]->getFecha();
                    $totaldeuda = $cuentacArray[$i]->getDeuda();
                    $estado = $cuentacArray[$i]->getEstado();
                    $cliente = new Persona();
                    $clienteArray = $cliente->BuscarPersona($idcliente);
                    $nombre_cliente = $clienteArray->getNombre();
                echo "<table id='example1' class='table table-bordered table-striped'>
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
                  <tbody>";
                    
                    echo "<tr>";
                         
                    echo "<td>$id</td>
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
                    <a type='submit' href='../ticket/Vista.php?id=$idventa'class='btn bg-gradient-primary' title='Visualizar Venta'>
                    <i class='fas fa-eye'></i> 
                    </a>&nbsp;&nbsp;";

                    echo "</tr>";

                }
            
               }
               
                echo "</tbody>
                </table>";

?>

                                    <div class="card-body">
                                        <div id="tablaCliente"></div>
                                    </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
               
               
    </section>

            <!-- /.row -->
        </div><!-- /.container-fluid -->
<script>
document.getElementById('id_cliente').addEventListener('change', function() {
    var clienteId = this.value;
    if (clienteId !== '') {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'detalle_cuenta_cobrar.php?id_cliente=' + clienteId, true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                document.getElementById('tablaCliente').innerHTML = xhr.responseText;
            } else {
                console.error('Error al cargar los datos del cliente');
            }
        };
        xhr.send();
    } else {
        document.getElementById('tablaCliente').innerHTML = '';
    }
});
</script>
<!-- /.content-wrapper -->
<?php  

include('layout/footer.php');

?>

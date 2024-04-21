<?php

include("layout/header.php");

?>

<title>CVDP|San Diego </title>

<?php

include("layout/nav.php");
include("../clases/Venta.php");


?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Registro de una nueva venta</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

           <div class="row">
               <div class="col-md-9">
                   <div class="row">
                       <div class="col-md-12">
                           <div class="card card-warning">
                               <div class="card-header">
                                   <h3 class="card-title">Venta</h3>
                                   <div class="card-tools">
                                       <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                       </button>
                                   </div>

                               </div>
                               <hr>
                               
                               <div class="container-fluid" style="font-size: 12px">
                               <div style="display: flex">
                                       <h5>Datos de la venta </h5>
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
                                   <form role="form" method="post" action="../crud/ventaingresar.php">
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
                                           <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Usuario</label>
                                                    <input type="text" class="form-control" value="<?php echo $_SESSION["nombre"]; ?>" disabled>
                                                    <input type="number" name="id_usuario" id="id_usuario" class="form-control" value="<?php echo $_SESSION["id"]; ?>" hidden>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                               <div class="form-group">
                                                   <label for="">Tipo de Comprobante</label>
                                                   <select class="form-control" name="tipoc" id="tipoc">
                                                        <option>Factura</option>
                                                        <option>Comprobante pago</option>
                                                    </select>
                                               </div>
                                           </div>          
                                       </div>     
                                       <div class="col-md-12"><center>
                                                <input type="submit" value="Agregar cliente a la venta" class="btn btn-primary" name="btnGuardarVenta" id="btnGuardarVenta">
                                                <a type="submit" class="btn btn-danger" href="venta.php">Regresar</a></center>
                                            </div>   
                                   </div>
                                   <hr>
                                   </form>
                                   
                           </div>
                       </div>
                   </div>
               </div>
               
               <div class="col-md-3">

                   <div class="row">
                       <div class="col-md-12">
                           <div class="card card-outline card-primary">
                               <div class="card-header">
                                   <h3 class="card-title">Detalle de la venta</h3>
                                   <div class="card-tools">
                                       <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                           <i class="fas fa-minus"></i>
                                       </button>
                                   </div>

                               </div>

                               <div class="card-body">
                                   <div class="row">
                                       <div class="col-md-12">
                                           <div class="form-group">
                                               
                                               <label for="">Número de la venta</label>
                                               <div id="listado"></div>
                                               <input type="text" style="text-align: center" class="form-control" disabled>
                                               <input type="text"  id="id_venta" hidden>
                                           </div>
                                       </div>

                                       <div class="col-md-12">
                                           <div class="form-group">
                                               <label for="">Fecha de la venta</label>
                                               <input type="date" class="form-control" id="fecha_venta" disabled>
                                           </div>
                                       </div>

                                       <div class="col-md-12">
                                           <div class="form-group">
                                               <label for="">Numero del Comprobante</label>
                                               <input type="text" class="form-control" id="num_comprobante" disabled>
                                           </div>
                                       </div>
                                       <div class="col-md-12">
                                           <div class="form-group">
                                               <label for="">Serie del Comprobante</label>
                                               <input type="text" class="form-control" id="num_comprobante" disabled>
                                           </div>
                                       </div>

                                       <div class="col-md-12">
                                           <div class="form-group">
                                               <label for="">Sub-Total venta</label>
                                               <input type="text" class="form-control" id="precio_venta"disabled>
                                           </div>
                                       </div>
                                       <div class="col-md-12">
                                           <div class="form-group">
                                               <label for="">Descuento</label>
                                               <input type="text" class="form-control" id="descuento"disabled>
                                           </div>
                                       </div>

                                       <div class="col-md-12">
                                           <div class="form-group">
                                               <label for="">cantidad Total</label>
                                               <input type="text" style="text-align: center" id="cantidad_total" class="form-control" disabled>
                                           </div>
                                       </div>
                                       
                                       
                                   </div>
                                   <hr>

                                   <div class="col-md-12">
                                       <div class="form-group">
                                           <button class="btn btn-success btn-block" id="btn_guardar_venta">Generar venta</button>
                                       </div>
                                   </div>
                                  
                               </div>

                           </div>

                       </div>

                    

                   </div>


               </div>
           </div>

            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php  

include('layout/footer.php');

?>

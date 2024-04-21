<?php

include("layout/header.php");

?>

<title>CVDP|San Diego </title>

<?php

include("layout/nav.php");
include("../clases/DetalleV.php");


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
                               <div class="card-body" style="display: block;">
                                   <div style="display: flex">
                                       <h5>Datos del producto </h5>
                                       <div style="width: 20px"></div>
                                       <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-buscar_producto">
                                           <i class="fa fa-search"></i>
                                           Buscar producto
                                       </button>
                                       <!-- modal para visualizar datos de los producto -->
                                       <div class="modal fade" id="modal-buscar_producto">
                                           <div class="modal-dialog modal-lg">
                                               <div class="modal-content">
                                                   <div class="modal-header" style="background-color: #EEA200; color: white">
                                                       <h4 class="modal-title">Busqueda del producto</h4>
                                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                           <span aria-hidden="true">&times;</span>
                                                       </button>
                                                   </div>
                                                   <div class="modal-body">
                                                       <div class="table table-responsive">
                                                           <table id="example3" class="table table-bordered table-striped table-sm">
                                                               <thead>
                                                               <tr>
                                                                   <th><center>Codigo</center></th>
                                                                   <th><center>Nombre</center></th>
                                                                   <th><center>Descripción</center></th>
                                                                   <th><center>Cantidad</center></th>
                                                                   <th><center>Precio venta</center></th>
                                                                   <th><center>Ubicacion</center></th>
                                                                   <th><center>Selecionar</center></th>
                                                               </tr>
                                                               </thead>
                                                               <tbody>
                                                               <?php
                                                               $ventaID = new DetalleV();
                                                               $ultimoIdVenta = $ventaID->ObtenerUltimoIdVenta();
                                                                $productoob = new Producto1();
                                                                $productoArray = $productoob->ObtenerProducto();

                                                                for($i=0; $i<sizeof($productoArray); $i++){
                                                                $id_producto = $productoArray[$i]->getIdproducto();
                                                                $nombre_producto = $productoArray[$i]->getNombre();
                                                                $descripcion = $productoArray[$i]->getDescripcion();
                                                                $cantidad_producto = $productoArray[$i]->getCantidad();
                                                                $precio_producto = $productoArray[$i]->getPrecio();
                                                                $ubicacion = $productoArray[$i]->getUbicacion();
                                                                
                                                                ?>
                                                                   <tr>
                                                                       <td><?php echo $id_producto; ?></td>
                                                                       <td><?php echo $nombre_producto;?></td>
                                                                       <td><?php echo $descripcion;?></td>
                                                                       <td><?php echo $cantidad_producto;?></td>
                                                                       <td><?php echo $precio_producto;?></td>
                                                                       <td><?php echo $ubicacion;?></td>
                                                                       <td>
                                                                           <button data-dismiss="modal" class="btn btn-success" id="btn_selecionar_producto<?php echo $id_producto;?>">
                                                                               Selecionar
                                                                           </button>
                                                                           <script>
                                                                                var modal2 = document.getElementById("modal-buscar_producto");
                                                                                var btn2 = document.getElementById("btn_selecionar_producto<?php echo $id_producto;?>");

                                                                                btn2.onclick = function()  {

                                                                                   var id_productos = '<?php echo $id_producto; ?>';
                                                                                   document.getElementById("id_producto").value = id_productos;

                                                                                   var id_productos1 = '<?php echo $id_producto; ?>';
                                                                                   document.getElementById("id_producto1").value = id_productos1;
                                                                                   
                                                                                   var nombre_productos = '<?php echo $nombre_producto; ?>';
                                                                                   document.getElementById("nombre_producto").value = nombre_productos;

                                                                                   var descripcion = '<?php echo $descripcion; ?>';
                                                                                   document.getElementById("descripcion").value = descripcion;

                                                                                   var cantidad_productos = '<?php echo $cantidad_producto; ?>';
                                                                                   document.getElementById('cantidad_producto').value = cantidad_productos;
                                                                                   
                                                                                   var precio_productos = '<?php echo $precio_producto; ?>';
                                                                                   document.getElementById('precio_producto').value = precio_productos;

                                                                                   var precio_productos2 = '<?php echo $precio_producto; ?>';
                                                                                   document.getElementById('precio_producto2').value = precio_productos2;

                                                                                   var id_venta = '<?php echo $ultimoIdVenta; ?>';
                                                                                   document.getElementById('id_venta').value = id_venta;

                                                                                   modal2.style.display = "none"; 
                                                                               };
                                                                           </script>
                                                                       </td>
                                                                       
                                                                       
                                                                   </tr>
                                                                <?php
                                                                }
                                                                ?>
                                                               </tbody>
                                                               </tfoot>
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
                                   <hr>
                                   <form role="form" method="post" action="../crud/ventadetalleingresar.php">
                                   <div class="container-fluid" style="font-size: 12px">
                                       <div class="row">
                                                
                                                <div class="col-md-4">
                                                   <div class="form-group">
                                                       <label for="">codigo:</label>
                                                       <input type="text" class="form-control" id="id_producto1" disabled>
                                                       <input type="number" class="form-control" name="id_venta" id="id_venta" hidden>
                                                       <input type="number" class="form-control" name="id_producto" id="id_producto" hidden>
                                                   </div>
                                               </div>
                                           <div class="col-md-4">
                                               <div class="form-group">
                                                   <label for="">Nombre del producto:</label>
                                                   <input type="text" name="nombre_producto" id="nombre_producto" class="form-control" disabled>
                                               </div>
                                           </div>
                                           <div class="col-md-4">
                                               <div class="form-group">
                                                   <label for="">Descripcion:</label>
                                                   <input type="text" name="descripcion" id="descripcion" class="form-control" disabled>
                                               </div>
                                           </div>             
                                       </div> 
                                       <div class="row">
                                                <div class="col-md-4">
                                                   <div class="form-group">
                                                       <label for="">Unidad Medida:</label>
                                                       <select type="text"class="form-control" name="unidad_medida" id="unidad_medida">
                                                            <option>Unidad</option>
                                                            <option>Metro (m)</option>
                                                            <option>Centimetro (cm)</option>
                                                            <option>Milimetro (mm)</option>
                                                            <option>Kilogramo (kg)</option>
                                                            <option>Gramo (g)</option>
                                                            <option>Onza</option>
                                                            <option>Libra</option>
                                                            <option>Quital</option>
                                                            <option>Arroba</option>
                                                        </select>
                                                   </div>
                                               </div>
                                                <div class="col-md-2">
                                                   <div class="form-group">
                                                       <label for="">Cantidad:</label>
                                                       <input type="number" name="cantidad_v" id="cantidad_v" class="form-control" style="background-color: #fff819" maxlength="cantidad_producto" required min="1">
                                                   </div>
                                               </div>
                                               
                                               <div class="col-md-2">
                                                   <div class="form-group">
                                                       <label for="">Cantidad Disponible:</label>
                                                       <input type="number" name="cantidad_producto" id="cantidad_producto" class="form-control" disabled>
                                                   </div>
                                               </div>
                                               <div class="col-md-2">
                                                   <div class="form-group">
                                                       <label for="">Precio:</label>
                                                       <input type="number"  id="precio_producto" class="form-control" disabled>
                                                       <input type="number" name="precio_producto2" id="precio_producto2" class="form-control" hidden>
                                                   </div>
                                               </div>
                                            
                                               
                                           </div> 
                                           <div class=""><center>
                                                <input type="submit" value="Agregar Producto" class="btn btn-success" name="btnGuardarDetalleVenta" id="btnGuardarDetalleVenta">
                                                </center>
                                            </div>    

                                   </div>
                                    </form>
                                   
                               </div>

                           </div>
                       </div>
                   </div>
               </div>
               
               <div class="col-md-3">

                   <div class="row">
                       <div class="col-md-50">
                           <div class="card card-outline card-primary">
                               <div class="card-header">
                                   <h3 class="card-title">Detalle de la venta</h3>
                                   <div class="card-tools">
                                       <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                           <i class="fas fa-minus"></i>
                                       </button>
                                   </div>

                               </div>
                               <form role="form" method="post" action="../crud/ventaeditar.php">
                               <div class="card-body">
                                   <div class="row">
                                    
                                       <div class="col-md-12">
                                           <div class="form-group">
                                               <label for="">Lista de Productos</label>
                                           </div>
                                       </div>
                                       
                                       <div class="table table-responsive">
                                            <table id="example3" class="table table-bordered table-striped table-sm">
                                                <thead>
                                                <tr>
                                                <th><center>Cod.</center></th>
                                                <th><center>Can.</center></th>
                                                <th><center>Precio</center></th>
                                                <th><center>Quitar</center></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $ventaID2 = new DetalleV();
                                                    $ultimoIdVenta2 = $ventaID2->ObtenerUltimoIdVenta();
                                                    $detallevob = new DetalleV();
                                                    $detallevArray = $detallevob->ObtenerDetalleV();

                                                    for($i=0; $i<sizeof($detallevArray); $i++){
                                                        $id_detallev = $detallevArray[$i]->getIdetallev();
                                                        $id_producto = $detallevArray[$i]->getIdproducto();
                                                        $id_venta = $detallevArray[$i]->getIdventa();
                                                        $cantidad_medida = $detallevArray[$i]->getCantidadm();
                                                        $precio_venta = $detallevArray[$i]->getPrecio();
                                                        $estado = $detallevArray[$i]->getEstado();
                                                        if($id_venta == $ultimoIdVenta2){
                                                            if($estado == 1){
                                                            
                                                        ?>
                                                    <tr>
                                                    <td><center><?php echo $id_producto; ?></center></td>
                                                    <td><center><?php echo $cantidad_medida;?></center></td>
                                                    <td><center><?php echo "Q.".$precio_venta;?></center></td>
                                                    <td><center>
                                                        <a href="../crud/eliminardetalleventa.php?id=<?php echo $id_detallev; ?>" class="btn btn-danger" >
                                                                X
                                                            </a></center>
                                                    </td>
                                                    </tr>
                                                    <?php
                                                }}}
                                                ?>
                                                </tbody>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <?php
                                            $ventaIDF = new DetalleV();
                                            $ultimoIdVentaF = $ventaIDF->ObtenerUltimoIdVenta();

                                            $ventaob = new Venta();
                                            $ventaArray = $ventaob->BuscarVenta($ultimoIdVentaF);

                                            $id_venta = $ventaArray->getIdventa();
                                            $fecha = $ventaArray->getFecha();
                                            $num_comprobante = $ventaArray->getComprobante();
                                            $serie = $ventaArray->getSerie();
                                            
                                            
                                        ?>
                                        <div class="col-md-12">
                                           <div class="form-group">
                                               <label for="">Número de la venta</label>
                                               <?php echo "
                                               <input type='text' style='text-align: center' value='$id_venta'class='form-control' disabled>
                                               <input type='text'  value='$id_venta' name='id_venta' id='id_venta' hidden>";?>
                                           </div>
                                       </div>

                                       <div class="col-md-12">
                                           <div class="form-group">
                                               <label for="">Fecha de la venta</label>
                                               <?php echo "
                                               <input type='text' class='form-control' id='fecha_venta'  value='$fecha' disabled>
                                               <input type='text' class='form-control' value='$fecha' name='fecha_venta' id='fecha_venta' hidden>";?>
                                           </div>
                                       </div>

                                       <div class="col-md-12">
                                           <div class="form-group">
                                               <label for="">Numero del Comprobante</label>
                                               <?php echo "
                                               <input type='number' style='text-align: center' value='$id_venta'class='form-control' disabled>
                                               <input type='number'  value='$id_venta' name='num_comprobante' id='num_comprobante' hidden>";?>
                                           </div>
                                       </div>
                                       <div class="col-md-12">
                                           <div class="form-group">
                                               <label for="">Serie del Comprobante</label>
                                               <?php echo "
                                               <input type='text' style='text-align: center' value='S-$id_venta'class='form-control' disabled>
                                               <input type='text'  value='S-$id_venta' name='serie' id='serie' hidden>";?>
                                           </div>
                                       </div>
                                       <?php
                                        $detalleVentaT = new DetalleV();
                                        $totalVenta = $detalleVentaT->CalcularTotalVenta($id_venta);
                                        ?>
                                       <div class="col-md-12">
                                           <div class="form-group">
                                               <label for="">Sub-Total venta</label>
                                               <?php echo "
                                               <input type='number' style='text-align: center' class='form-control' value='$totalVenta' disabled>
                                               <input type='number' value='$totalVenta' class='form-control' name='sub_total' id='sub_total'   hidden>";?>
                                           </div>
                                       </div>
                                       <div class="col-md-12">
                                           <div class="form-group">
                                               <label for="">Descuento</label>
                                               <input type="number" style="text-align: center" min=0 oninput="validity.valid||(value='');" class="form-control" name="descuento" id="descuento">
                                           </div>
                                       </div>
                                       <script>
                                        // Función para calcular el total general
                                        function calcularTotalGeneral() {
                                        // Obtener el valor del descuento
                                        var descuento = parseFloat(document.getElementById('descuento').value);
                                        // Obtener el valor del total de la venta (asumido como 100 por simplicidad)
                                        var totalVenta = parseFloat(document.getElementById('sub_total').value);
                                        // Calcular el total general restando el descuento al total de la venta
                                        var totalGeneral = totalVenta - descuento;
            
                                         // Mostrar el total de la venta y el total general en los elementos HTML correspondientes
           
                                        document.getElementById('cantidad_total').textContent = totalGeneral.toFixed(2);
                                        }

                                        // Obtener el elemento de entrada del descuento
                                        var inputDescuento = document.getElementById('descuento');
                                        // Agregar un evento de escucha al campo de entrada del descuento para que el cálculo se realice automáticamente
                                        inputDescuento.addEventListener('input', calcularTotalGeneral);
                                        </script>
                                       <div class="col-md-12">
                                           <div class="form-group">
                                               <label for="">cantidad Total</label><br><center>
                                               <span id="">Q.  </span>
                                               <span id="cantidad_total">0</span></h2></center>
                                               
                                           </div>
                                       </div>
                                       
                                       
                                   </div>
                                   <hr>
                                   
                                   
                                   <div class="col-md-12">
                                       <div class="form-group">
                                           <button class="btn btn-primary btn-block" name="btnEditarVenta" id="btnEditarVenta">Guardar venta</button>
                                       </div>
                                   </div>
                                  
                               </div>
                               </form>

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
<script>
  $(function () {
    $("#example3").DataTable({
      "responsive": true,
      "autoWidth": false,
      language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ registros",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "zeroRecords": "Sin resultados encontrados",
                    
                },
    });
 
  });
</script>
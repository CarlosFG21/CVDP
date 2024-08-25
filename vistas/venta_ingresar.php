<?php

include("layout/header.php");

?>

<title>CVDP|San Diego </title>

<?php

include("layout/nav.php");
include("../clases/DetalleV.php");


?>
<script src="../js/ventainsertar.js"></script>
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
               <div class="col-md-8">
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
                                       <h5>Venta</h5>
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
                                   <form id="formularioVentas">
                                   <div class="container-fluid" style="font-size: 12px">
                                       <div class="row">
                                                
                                                <div class="col-md-4">
                                                   <div class="form-group">
                                                       <label for="">codigo:</label>
                                                       <input type="text" class="form-control" id="id_producto1" disabled>
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
                                                            <option>-----</option>
                                                            <option>Metro (m)</option>
                                                            <option>Centimetro (cm)</option>
                                                            <option>Milimetro (mm)</option>
                                                            <option>Yarda</option>
                                                            <option>Pulgada</option>
                                                            <option>Kilogramo (kg)</option>
                                                            <option>Gramo (g)</option>
                                                            <option>Onza</option>
                                                            <option>Libra</option>
                                                            <option>Quital</option>
                                                            <option>Arroba</option>
                                                            <option>Saco</option>
                                                            <option>Galon</option>
                                                            <option>Caja</option>
                                                            <option>Bolsa</option>
                                                        </select>
                                                   </div>
                                               </div>
                                                <div class="col-md-2">
                                                   <div class="form-group">
                                                       <label for="">Cantidad:</label>
                                                       <input type="number" step="0.01" name="cantidad_v" id="cantidad_v" class="form-control" style="background-color: #fff819">
                                                   </div>
                                               </div>
                                               
                                               <div class="col-md-2">
                                                   <div class="form-group">
                                                       <label for="">Cant. Disponible:</label>
                                                       <input type="number" name="cantidad_producto" id="cantidad_producto" class="form-control" disabled>
                                                   </div>
                                               </div>
                                               <div class="col-md-2">
                                                   <div class="form-group">
                                                       <label for="">Precio:</label>
                                                       <input type="number"  id="precio_producto" class="form-control" disabled>
                                                       <input type="number" step="any" name="precio_producto2" id="precio_producto2" class="form-control" hidden>
                                                   </div>
                                               </div>
                                               
                                                <script>
                                                    document.addEventListener("DOMContentLoaded", function() {
                                                    var cantidadInput = document.getElementById('cantidad_v');
                                                    var cantidadDisponibleInput = document.getElementById('cantidad_producto');

                                                    cantidadInput.addEventListener('input', function() {
                                                    var cantidad = parseFloat(cantidadInput.value); // Utilizar parseFloat en lugar de parseInt
                                                    var cantidadDisponible = parseFloat(cantidadDisponibleInput.value); // Utilizar parseFloat en lugar de parseInt

                                                    if (cantidad <= 0 || isNaN(cantidad)) {
                                                        alert('La cantidad ingresada debe ser un número positivo mayor que cero.');
                                                        cantidadInput.value = '0.01'; // Vaciar el campo si se ingresa 0 o un valor negativo
                                                    } else if (cantidad > cantidadDisponible) {
                                                        alert('La cantidad ingresada es mayor que la cantidad disponible');
                                                        cantidadInput.value = cantidadDisponible; // Restablecer la cantidad al máximo disponible
                                                     }
                                                    });
                                                    });
                                                </script>
                                            
                                               
                                           </div> 
                                           <div class=""><center>
                                                <input type="button"  class="btn btn-success" value="Agregar Producto"  onclick="agregarVenta()">
                                                <a type="submit" class="btn btn-danger" href="Venta.php">Regresar</a></center>
                                                </center>
                                            </div>    

                                   </div>
                                    </form>
                               </div>

                           </div>
                       </div>
                   </div>
               </div>
               
               <div class="col-md-4">

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

                               </div><div class="card-body">
                               <div class="row">
                               <div class="col-md-12">
                                           <div class="form-group">
                                               <label for="">Lista de Productos</label>
                                           </div>
                                       </div>
                               <div class="table table-responsive">
                                            <table id="tablaVentas" class="table table-bordered table-striped table-sm">
                                                <thead>
                                                <tr>
                                                <th><center>Cod.</center></th>
                                                <th><center>Can.</center></th>
                                                <th><center>Unid. M</center></th>
                                                <th><center>Precio</center></th>
                                                <th><center>Sub Total</center></th>
                                                <th><center>Quitar</center></th>
                                                </tr>
                                                </thead>
                                                <tbody id="bodyTablaVentas">
                                                </tbody>
                                                </tfoot>
                                            </table>
                                        </div>
                                       
                               </div>
                               <form role="form" method="post" action="../crud/ventaingresar.php" onsubmit="return validarFormulario()">
                               <div class="card-body">
                               
                                   <div class="row">
                                    
                                   <input type="hidden" id="datosTabla" name="datosTabla">
                                        <div class="col-md-12">
                                           <div class="form-group">
                                               <label for="">Nombre del cliente</label>
                                               <input type="number" name="id_cliente" id="id_cliente" class="form-control" hidden>
                                               <input type="number" name="id_usuario" id="id_usuario" class="form-control" value="<?php echo $_SESSION["id"]; ?>" hidden>
                                                <input type="text" name="nombre_cliente" id="nombre_cliente" class="form-control" disabled required>
                                                <input type="number" name="nit_cliente" id="nit_cliente" class="form-control" disabled required>
                                           </div>
                                       </div>
                                       <div class="col-md-12">
                                               <div class="form-group">
                                                   <label for="">Tipo de Comprobante</label>
                                                   <select class="form-control" name="tipoc" id="tipoc">
                                                        <option>Factura</option>
                                                        <option>Comprobante pago</option>
                                                    </select>
                                               </div>
                                           </div> 
                                       
                                       <div class="col-md-12">
                                               <div class="form-group">
                                                   <label for="">Metodo de pago</label>
                                                   <select class="form-control" name="pago" id="pago">
                                                        <option value="1">Efectivo</option>
                                                        <option value="2">Al credito</option>
                                                    </select>
                                               </div>
                                        </div>
                                       
                                       <div class="col-md-12">
                                           <div class="form-group">
                                               <label for="">Sub-Total venta</label>
                                               <input type="number" name="sub_total" step="any" id="sub_total" style="text-align: center" class="form-control" required>
                                           </div>
                                       </div>
                                       <div class="col-md-12">
                                           <div class="form-group">
                                               <label for="">Descuento</label>
                                               <input type="number"  step="any" style="text-align: center" min=0 oninput="validity.valid||(value='');" class="form-control" name="descuento" id="descuento" required>
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
                                           <button type="submit" class="btn btn-primary btn-block" name="btnNuevaVenta" id="btnNuevaVenta">Guardar venta</button>
                                       </div>
                                   </div>
                                  
                               </div>
                               <script>
                                    function validarFormulario() {
                                    // Validar nombre_cliente y nit_cliente
                                    var nombreCliente = document.getElementById('nombre_cliente').value;
                                    var nitCliente = document.getElementById('nit_cliente').value;
                                    var descuento = document.getElementById('descuento').value;

                                    if (nombreCliente.trim() === '' || nitCliente.trim() === '' || descuento.trim()=='') {
                                    alert('Por favor, completa todos los campos obligatorios.');
                                    return false; // Evita que el formulario se envíe
                                    }
                                        // Aquí puedes agregar más validaciones según tus necesidades
                                    return true; // Permite el envío del formulario si pasa todas las validaciones
                                    }
                                    </script>
                               </form>
                               </div></div>

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
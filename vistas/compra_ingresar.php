<?php
  include("layout/header.php");
  include("../clases/Producto.php");
?>

    <title>CVDP | San Diego</title>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<?php
  include("layout/nav.php");
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Productos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form role="form" method="post" action="">
                        <div class="row">
                            <div class="col-sm-9">
                                <!-- general form elements disabled -->
                                <div class="card card-warning">
                                    <div class="card-header">
                                        <h3 class="card-title">Ingresar Compra</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <?php 
                                             if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'existe'){
                                        ?>
                                        <div class="alert alert-danger alert-dismissible col-sm-6">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <h5><i class="icon fas fa-exclamation-triangle"></i> Alerta!</h5>
                                            !El rol a ingresar ya existe.!
                                        </div>
                                        <?php
                                            }
                                        ?>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <!-- text input -->
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-12">

                                                            <button type="button" class="btn btn-secondary"
                                                                data-toggle="modal"
                                                                data-target="#proveedorModal">Agregar Proveedor</button>
                                                            <button type="button" class="btn btn-primary"
                                                                data-toggle="modal" data-target="#productoModal">Agregar
                                                                Productos</button>
                                                            <table class="table table-bordered table-striped mt-4">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Id</th>
                                                                        <th>Producto</th>
                                                                        <th>Cantidad</th>
                                                                        <th>Unidad Medida</th>
                                                                        <th>Precio</th>
                                                                        <th>Eliminar</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="tablaProductos">
                                                                    <!-- Aquí se mostrarán los datos ingresados -->
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <td colspan="5" align="right">Total:</td>
                                                                        <td id="total">0.00</td>
                                                                        <td><input type="hidden" name="total"
                                                                                id="totalInput"></td>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                            <!--/div-->
                                                            <div class="">
                                                                <input type="submit" value="Guardar"
                                                                    class="btn btn-primary" name="btnGuardarCompra"
                                                                    id="btnGuardarCompra">
                                                                <a type="submit" class="btn btn-danger"
                                                                    href="compra.php">Regresar</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card card-warning">
                                    <div class="card-header">
                                        <h3 class="card-title">Datos del Proveedor</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-12" id="datosproveedor">
                                                            <!-- Aquí se mostrarán los datos ingresados -->
                                                            <label for="idproveedor">Id</label>
                                                            <input type="text" class="form-control mb-2"
                                                                name="idproveedor" id="idproveedor" readonly>
                                                            <label for="nombrep">Proveedor</label>
                                                            <input type="text" class="form-control mb-2" name="nombrep"
                                                                id="nombrep" readonly>
                                                            <label for="nit">Nit</label>
                                                            <input type="text" class="form-control mb-2" name="nit"
                                                                id="nit" readonly>
                                                            <label for="impuesto">Impuesto</label>
                                                            <input type="text" class="form-control mb-2" name="impuesto"
                                                                id="impuesto" required>
                                                            <label for="tipocomprobante">Tipo Comprobante</label>
                                                            <select class="form-control mb-2" name="tipocomprobante"
                                                                id="tipocomprobante" style="width: 100%;"
                                                                onchange="actualizarInputs()" required>
                                                                <option value="">Seleccionar</option>
                                                                <option value="factura">Factura</option>
                                                                <option value="comprobante pago">Comprobante pago
                                                                </option>
                                                            </select>
                                                            <label for="ncomprobante">Numero de Comprobante</label>
                                                            <input type="text" class="form-control mb-2"
                                                                name="ncomprobante" id="ncomprobante" readonly>
                                                            <label for="scomprobante">Serie de Comprobante</label>
                                                            <input type="text" class="form-control mb-2"
                                                                name="scomprobante" id="scomprobante" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <style>
                        /* Personaliza el contenedor de Select2 */
                        .select2-container .select2-selection--single {
                            height: 1000px;
                            padding: 0; /* Quita el padding para centrar verticalmente */
                            font-size: 16px;
                            border-radius: 5px;
                            border: 1px solid #ced4da;
                            display: flex;
                            align-items: center; /* Centra verticalmente */
                            justify-content: center; /* Centra horizontalmente */
                        }

                        /* Personaliza el placeholder de Select2 */
                        .select2-container--default .select2-selection--single .select2-selection__placeholder {
                            color: #6c757d;
                            font-style: italic;
                        }
                    </style>

                    <!-- Modal producto-->
                    <div class="modal fade" id="productoModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Agregar Producto</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <select name="producto" id="producto" class="form-control select2" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                            <?php
                                                $producto = new Producto();
                                                $productoArray = $producto->ObtenerProductos();

                                                for($i=0; $i<sizeof($productoArray); $i++){
                                                $id = $productoArray[$i]->getIdproducto();
                                                $nombre = $productoArray[$i]->getNombre();
                                                echo '<option value='.$id.'>'.$nombre.'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <input type="number" id="cantidad" class="form-control mb-2" placeholder="Cantidad">
                                    <select type="text" class="form-control mb-2" name="unidadm" id="unidadm">
                                        <option>Unidad Medida:</option>
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
                                    <input type="number" id="precio" class="form-control mb-2" placeholder="Precio">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="button" class="btn btn-primary" data-dismiss="modal"
                                        onclick="agregarProductos()">Agregar</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Modal proveedor -->
                    <div class="modal fade" id="proveedorModal" tabindex="-1" role="dialog"
                        aria-labelledby="proveedorModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="proveedorModalLabel">Agregar Proveedor</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <select name="proveedor" id="proveedor" class="form-control mb-2 select2" style="width: 100%;">
                                        <?php
                                            $persona = new Producto();
                                            $personaArray = $persona->ObtenerPersonas();

                                            for($i=0; $i<sizeof($personaArray); $i++){
                                            $id = $personaArray[$i]->getIdproducto();
                                            $nombre = $personaArray[$i]->getNombre();
                                            $tipo = $personaArray[$i]->getIdcategoria();
                                            echo '<option value='.$id.'>'.$id.' - '.$nombre.' - '.$tipo.'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="button" class="btn btn-primary" data-dismiss="modal"
                                        onclick="agregarProveedor()">Agregar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/.col (right) -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>


<?php
  include("layout/footer.php");
?>

<script>
    const Idproducto = [];
    const Cantidad = [];
    const Unidadmedida = [];
    const Precio = [];
    var Idproveedor;
    var Nombrep;
    var Nit;
    var Impuesto;
    var Tipocomprobante;
    var Ncomprobante;
    var Scomprobante;


    function agregarProductos() {
    var producto = document.getElementById('producto');
    var selectedIndex = producto.selectedIndex;
    // Obtener el texto de la opción seleccionada
    var texprod = producto.options[selectedIndex].textContent;
    var idproducto = document.getElementById("producto").value

    var cantidad = document.getElementById("cantidad").value;
    var unidadm = document.getElementById("unidadm").value;
    var precio = parseFloat(document.getElementById("precio").value); // Convertir a número flotante
    var total = parseFloat($("#total").text()); // Obtener el total actual

    // Crear una nueva fila en la tabla con los datos ingresados
    var fila = "<tr><td>" + idproducto + "</td><td>" + texprod + "</td><td>" + cantidad + "</td><td>" + unidadm +
        "</td><td>" + precio.toFixed(2) +
        "</td><td><button type='button' class='btn btn-danger btn-sm' onclick='eliminarFila(this)'>Eliminar</button></td></tr>";
    $("#tablaProductos").append(fila);

    // Actualizar el total sumando el precio del producto agregado
    total = total + precio * cantidad;
    // Mostrar el total en el pie de la tabla
    $("#total").text(total.toFixed(2));
    // Después de actualizar el total en el pie de la tabla, actualiza el input oculto
    $("#totalInput").val(total.toFixed(2));

    // Agregar los valores a las variables globales
    Idproducto.push(idproducto);
    Cantidad.push(cantidad);
    Unidadmedida.push(unidadm);
    Precio.push(precio);

    // Limpiar los campos del modal
    $("#producto").val("");
    $("#cantidad").val("");
    $("#unidadm").val("");
    $("#precio").val("");

    // Cerrar el modal
    $("#productoModal").modal("hide");
    }

    // Función para eliminar la fila de la tabla
    function eliminarFila(boton) {
    // Obtener el precio del producto a eliminar
    var precioEliminar = parseFloat($(boton).closest("tr").find("td").eq(5).text());
    var cantidadEliminar = parseFloat($(boton).closest("tr").find("td").eq(2).text());
    // Restar el precio del producto eliminado al total
    var totalActual = parseFloat($("#total").text());
    var totalNuevo = totalActual - precioEliminar * cantidadEliminar;
    // Actualizar el total en el pie de la tabla
    $("#total").text(totalNuevo.toFixed(2));
    $("#totalInput").val(totalNuevo.toFixed(2));
    // Eliminar la fila de la tabla
    $(boton).closest("tr").remove();
    }
</script>


<script>
    function agregarProveedor() {
    // Obtener el proveedor seleccionado
    var proveedorSelect = document.getElementById("proveedor");
    var proveedorSeleccionado = proveedorSelect.options[proveedorSelect.selectedIndex].text;

    // Obtener los datos del proveedor seleccionado
    var idProveedor = proveedorSeleccionado.split(' - ')[0];
    var nombreProveedor = proveedorSeleccionado.split(' - ')[1];
    var nitProveedor = proveedorSeleccionado.split(' - ')[2];

    // Mostrar los datos del proveedor en los campos de texto
    document.getElementById("idproveedor").value = idProveedor;
    document.getElementById("nombrep").value = nombreProveedor;
    document.getElementById("nit").value = nitProveedor;
    }
</script>

<script>
    function actualizarInputs() {
    var seleccionado = document.getElementById("tipocomprobante").value;
    $.ajax({
        url: '../crud/idcompra.php',
        type: 'POST',
        data: {
            tipocomprobante: seleccionado
        },
        dataType: 'json',
        success: function(data) {
            document.getElementById("ncomprobante").value = data.idcompra;
            document.getElementById("scomprobante").value = 'S' + data.idcompra;
            console.log(data);
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            alert("Error al obtener los datos.");
        }
    });
    }

    function guardarDatos() {
    var Idproveedor = $("#idproveedor").val();
    var Impuesto = $("#impuesto").val();
    var Tipocomprobante = $("#tipocomprobante").val();
    var Ncomprobante = $("#ncomprobante").val();
    var Scomprobante = $("#scomprobante").val();
    var Total = $("#totalInput").val();

    var formData = {
        Idproveedor: Idproveedor,
        Tipocomprobante: Tipocomprobante,
        Ncomprobante: Ncomprobante,
        Scomprobante: Scomprobante,
        Impuesto: Impuesto,
        Total: Total,
        Idproducto: Idproducto, // Suponiendo que estas son tus variables globales
        Cantidad: Cantidad,
        Unidadmedida: Unidadmedida,
        Precio: Precio
    };

    // Imprimir los datos antes de enviarlos al servidor
    console.log("Datos a enviar:", formData);

    // Enviar los datos al servidor mediante una solicitud AJAX
    //event.preventDefault();
    $.ajax({
        url: '../crud/compra.php',
        type: 'POST',
        dataType: 'json',
        data: formData,
        success: function(response) {
            // Manejar la respuesta del servidor
            console.log(response);
        },
        error: function(xhr, status, error) {
            // Manejar errores
            console.error(error);
        }
    });
    }

    // Llamar a la función cuando se haga clic en el botón de guardar
    $('#btnGuardarCompra').click(function() {
    guardarDatos();
    });
</script>

<script type="text/javascript">
  $('#producto').select2({
        dropdownParent: $('#productoModal .modal-body')
    });
    $('#proveedor').select2({
        dropdownParent: $('#proveedorModal .modal-body')
    });
</script>
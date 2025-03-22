<?php

include("../clases/DetalleCotizacion.php");

if(isset($_POST["btnGuardarCotizacion"])){
  $conexion = new conexion();
  $conexion->conectar();
  $sql2 = "SELECT MAX(id_cotizacion) FROM cotizacion";
  $result2 = mysqli_query($conexion->db, $sql2);

  if ($result2) {
  $row = mysqli_fetch_array($result2);
  $ultimoId = $row[0];
  // Incrementar el último ID obtenido en 1
  $nuevoId = $ultimoId + 1;
  } else {
  $nuevoId = 1; // Si no hay ventas previas, comenzar desde el ID 1
  }
  $id_cotizacion = $nuevoId; 

$id_cliente = $_POST['id_cliente'];
$id_usuario = $_POST['id_usuario'];
$descripcion = $_POST['descripcion'];

$subtotal = $_POST['sub_total'];
$descuento = $_POST['descuento'];
$pago_instalacion = $_POST['pago_instalacion'];

// Obtener los datos de la tabla enviados desde el formulario
$datosTabla = json_decode($_POST['datosTabla'], true);

$cotizacionN = new cotizacion();
$detalleCotizacion = new DetalleCotizacion();
    
  if($cotizacionN->ValidarCotizacion($id_cliente,$id_usuario)==0){

    $total = $subtotal-$descuento+$pago_instalacion;  
    $cotizacionN->GuardarCotizacion($id_cliente,$id_usuario,$descripcion,$descuento,$pago_instalacion,$total);

    $detalleCotizacion->NuevoDetalleC($datosTabla,$id_cotizacion);

  header("Location: ../vistas/cotizacion.php");

}else{

  header("Location: ../vistas/cotizacion_ingresar.php?mensaje=existe");

}

}

?>
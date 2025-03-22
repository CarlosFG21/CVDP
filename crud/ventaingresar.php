<?php

include("../clases/DetalleCuentaC.php");

if(isset($_POST["btnNuevaVenta"])){ 
  $conexion = new conexion();
  $conexion->conectar();
  $sql2 = "SELECT MAX(id_venta) FROM venta";
  $result2 = mysqli_query($conexion->db, $sql2);

  if ($result2) {
  $row = mysqli_fetch_array($result2);
  $ultimoId = $row[0];
  // Incrementar el último ID obtenido en 1
  $nuevoId = $ultimoId + 1;
  } else {
  $nuevoId = 1; // Si no hay ventas previas, comenzar desde el ID 1
  }
  $n_comprobante = $nuevoId;
  $serie = "S-".$nuevoId;
  $id_venta = $nuevoId; 

$venta = new Venta();
$cuentaporcobrar = new CuentaC();
$detalleVenta = new DetalleV();

$id_cliente = $_POST['id_cliente'];
$id_usuario = $_POST['id_usuario'];
$tipoc = $_POST['tipoc'];
$subtotal = $_POST['sub_total'];
$descuento = $_POST['descuento'];
$pago_instalacion = $_POST['pago_instalacion'];
$pago = $_POST['pago'];
// Obtener los datos de la tabla enviados desde el formulario
$datosTabla = json_decode($_POST['datosTabla'], true);

if($venta->ValidarVenta2($id_venta)==0){
    
$total = $subtotal-$descuento+$pago_instalacion;    
$venta->NuevaVenta($id_cliente,$id_usuario,$tipoc,$n_comprobante,$serie,$descuento,$pago_instalacion,$total,$pago);

$detalleVenta->NuevoDetalleV($datosTabla,$id_venta);


if($pago == 2){
  $cuentaporcobrar->GuardarCuentaC1($id_cliente,$total);
}
header("Location: ../vistas/venta.php");

}else{

        
    header("Location: ../vistas/venta_editar.php?id=$id_venta&mensaje=existe");

}

}


?>
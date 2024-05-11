<?php

include("../clases/DetalleV.php");

$id_venta = $_POST['id_venta'];
$id_producto = $_POST['id_producto'];
$cantidad_Medida = $_POST['cantidad_v'];
$Unidad_medida = $_POST['unidad_medida'];
$precio_producto = $_POST['precio_producto2'];

$ventaD = new DetalleV();

if(isset($_POST["btnGuardarDetalleVenta"])){
    $estado = 1;
    $subtotal = $cantidad_Medida * $precio_producto;
    $subtotal = round($subtotal, 2);
  if($ventaD->ValidarDetalleV($id_venta,$id_producto)==0){
    
  $ventaD->GuardarDetalleV($id_venta,$id_producto,$cantidad_Medida,$Unidad_medida,$subtotal,$estado);

  header("Location: ../vistas/ventadetalle_ingresar.php");

}else{

  header("Location: ../vistas/ventadetalle_ingresar.php?mensaje=existe");

}

}


?>
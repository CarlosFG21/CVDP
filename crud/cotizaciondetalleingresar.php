<?php

include("../clases/DetalleCotizacion.php");

$id_cotizacion = $_POST['id_cotizacion'];
$id_producto = $_POST['id_producto'];
$cantidad_Medida = $_POST['cantidad_v'];
$Unidad_medida = $_POST['unidad_medida'];
$precio_producto = $_POST['precio_producto2'];

$cotizacionD = new DetalleCotizacion();

if(isset($_POST["btnGuardarDetalleCotizacion"])){
    $estado = 1;
    $subtotal = $cantidad_Medida * $precio_producto;
    $subtotal = round($subtotal, 2);
  if($cotizacionD->ValidarDetalleCotizacion($id_cotizacion,$id_producto)==0){
    
  $cotizacionD->GuardarDetalleCotizacion($id_cotizacion,$id_producto,$cantidad_Medida,$Unidad_medida,$subtotal,$estado);

  header("Location: ../vistas/cotizaciondetalle_ingresar.php");

}else{

  header("Location: ../vistas/cotizaciondetalle_ingresar.php?mensaje=existe");

}

}


?>
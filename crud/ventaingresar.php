<?php

include("../clases/Venta.php");

$id_cliente = $_POST['id_cliente'];
$id_usuario = $_POST['id_cliente'];
$tipoc = $_POST['tipoc'];
$n_comprobante = $_POST['n_comprobante'];
$serie = $_POST['serie'];
$fecha = $_POST['fecha'];
$total = $_POST['total'];
$pago = $_POST['pago'];

$venta = new Venta();


if(isset($_POST["btnGuardarVenta"])){

  if($venta->ValidarVenta($id_cliente,$n_comprobante)==0){

  $venta->GuardarVenta($id_cliente,$id_usuario,$tipoc,$n_comprobante,$serie,$fecha,$total,$pago);

  header("Location: ../vistas/venta.php");

}else{

  header("Location: ../vistas/venta_ingresar.php?mensaje=existe");

}


}


?>
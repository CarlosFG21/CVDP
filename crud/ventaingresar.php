<?php

include("../clases/Venta.php");

$id_cliente = $_POST['id_cliente'];
$id_usuario = $_POST['id_usuario'];
$tipoc = $_POST['tipoc'];

$venta = new Venta();

if(isset($_POST["btnGuardarVenta"])){

  if($venta->ValidarVenta($id_cliente,$id_usuario)==0){

  $venta->GuardarVenta2($id_cliente,$id_usuario,$tipoc);

  header("Location: ../vistas/ventadetalle_ingresar.php");

}else{

  header("Location: ../vistas/venta_ingresar.php?mensaje=existe");

}

}

?>
<?php

include("../clases/Cotizacion.php");

$id_cliente = $_POST['id_cliente'];
$id_usuario = $_POST['id_usuario'];
$descripcion = $_POST['descripcion'];

$cotizacion = new cotizacion();

if(isset($_POST["btnGuardarCotizacion"])){

  if($cotizacion->ValidarCotizacion($id_cliente,$id_usuario)==0){


  $cotizacion->GuardarCotizacion($id_cliente,$id_usuario,$descripcion);

  header("Location: ../vistas/cotizaciondetalle_ingresar.php");

}else{

  header("Location: ../vistas/cotizacion_ingresar.php?mensaje=existe");

}

}

?>
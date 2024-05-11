<?php
    include("../clases/DetalleV.php");

    $detalleventa = new DetalleV();
    $id = $_REQUEST['id'];
    $cantidadp = $_REQUEST['cantidadp'];
    $idproducto = $_REQUEST['idproducto'];

    $detalleventa->EliminarDetalleV($id,$idproducto,$cantidadp);
    header("Location: ../vistas/ventadetalle_ingresar.php");

?>
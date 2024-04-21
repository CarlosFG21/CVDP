<?php
    include("../clases/DetalleV.php");

    $detalleventa = new DetalleV();
    $id = $_REQUEST['id'];

    $detalleventa->EliminarDetalleV($id);
    header("Location: ../vistas/ventadetalle_ingresar.php");

?>
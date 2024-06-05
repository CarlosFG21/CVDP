<?php
    include("../clases/Detallev.php");

    $venta = new DetalleV();
    $id = $_REQUEST['id'];

    $venta->EliminarVenta1($id);
    header("Location: ../vistas/venta.php");

?>
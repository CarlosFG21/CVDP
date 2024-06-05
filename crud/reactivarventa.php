<?php
    include("../clases/Detallev.php");

    $venta = new DetalleV();
    $id = $_REQUEST['id'];

    $venta->ReactivarVenta1($id);
    header("Location: ../vistas/Venta.php");

?>
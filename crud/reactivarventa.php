<?php
    include("../clases/Venta.php");

    $venta = new Venta();
    $id = $_REQUEST['id'];

    $venta->reactivarVenta($id);
    header("Location: ../vistas/Venta.php");

?>
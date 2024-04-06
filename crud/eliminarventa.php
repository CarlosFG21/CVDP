<?php
    include("../clases/Venta.php");

    $venta = new Venta();
    $id = $_REQUEST['id'];

    $venta->EliminarVenta($id);
    header("Location: ../vistas/venta.php");

?>
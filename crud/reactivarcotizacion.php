<?php
    include("../clases/Cotizacion.php");

    $cotizacion = new cotizacion();
    $id = $_REQUEST['id'];

    $cotizacion->ReactivarCotizacion($id);
    header("Location: ../vistas/cotizacion.php");

?>
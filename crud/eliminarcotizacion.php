<?php
    include("../clases/Cotizacion.php");

    $cotizacion = new cotizacion();
    $id = $_REQUEST['id'];

    $cotizacion->EliminarCotizacion($id);
    header("Location: ../vistas/cotizacion.php");

?>
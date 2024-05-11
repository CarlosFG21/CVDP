<?php
    include("../clases/DetalleCotizacion.php");

    $detallecotizacion = new DetalleCotizacion();
    $id = $_REQUEST['id'];

    $detallecotizacion->EliminarDetalleCotizacion($id);
    header("Location: ../vistas/cotizaciondetalle_ingresar.php");

?>
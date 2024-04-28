<?php
    include("../clases/Compra.php");
    include("../db/conexion.php");

    if (isset($_POST['tipocomprobante'])) {
        $tipocomprobante = htmlspecialchars($_POST['tipocomprobante']);
        $conexion = new conexion();
        $conexion->conectar();
        $compra = new Compra();
        $ultimaCompra = $compra->ObtenerUltimaCompra($conexion);
        $ultimaCompraId = $ultimaCompra->getIdcompra()+1;
        $datos = array(
            'idcompra' => $ultimaCompraId
        );
        echo json_encode($datos);
    } else {
        echo json_encode(array('error' => 'No se recibió un valor válido para "tipocomprobante"'));
    }
?>


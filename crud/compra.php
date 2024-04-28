<?php
session_start();
$idusuario = $_SESSION['id'];
include("../db/conexion.php");
include("../clases/Compra.php");
include("../clases/DetalleC.php");

$compra = new Compra();
$detalleCompra = new DetalleC();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conexion = new conexion();
    $conexion->conectar();
    
    // Validar y procesar los datos recibidos desde la función JavaScript
    if(isset($_POST['Idproveedor'], $_POST['Tipocomprobante'], $_POST['Ncomprobante'], $_POST['Scomprobante'], $_POST['Impuesto'], $_POST['Total'])) {
        // Recopilar los datos recibidos
        $idproveedor = $_POST['Idproveedor'];
        $tipocomprobante = $_POST['Tipocomprobante'];
        $ncomprobante = $_POST['Ncomprobante'];
        $scomprobante = $_POST['Scomprobante'];
        $impuesto = $_POST['Impuesto'];
        $total = $_POST['Total'];
        $idcompra = $ncomprobante;

        // Llamar a la función para guardar la compra
        $compra->GuardarCompra($conexion, $idusuario, $idproveedor, $tipocomprobante, $ncomprobante, $scomprobante, $impuesto, $total);
        
        // Recopilar los detalles del producto
        $idproducto = $_POST['Idproducto'];
        $cantidad = $_POST['Cantidad'];
        $unidadmedida = $_POST['Unidadmedida'];
        $cantidadmedida = $_POST['Cantidadmedida'];
        $precio = $_POST['Precio'];

        // Imprimir los datos recibidos para verificar
        echo "idproducto: "; var_dump($idproducto); echo "<br>";
        echo "idproducto: "; var_dump($idproducto); echo "<br>";
        echo "cantidad: "; var_dump($cantidad); echo "<br>";
        echo "unidadmedida: "; var_dump($unidadmedida); echo "<br>";
        echo "cantidadmedida: "; var_dump($cantidadmedida); echo "<br>";
        echo "precio: "; var_dump($precio); echo "<br>";

        // Guardar detalles de compra
        foreach ($idproducto as $key => $idprod) {
            $detalleCompra->GuardarDetalleCompra($conexion, $idcompra, $idprod, $cantidad[$key], $unidadmedida[$key], $cantidadmedida[$key], $precio[$key]);
        }

        // Redirigir al usuario después de guardar la compra
        header("Location: ../vistas/compra.php");
    } else {
        // Si faltan datos en $_POST, manejar el error apropiadamente
        echo "Faltan datos en la solicitud POST.";
    }
}
?>

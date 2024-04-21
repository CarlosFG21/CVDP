<?php 

include("../clases/Venta.php");

if(isset($_POST["btnEditarVenta"])){  


$venta = new Venta();

$id_venta = $_POST['id_venta'];
$n_comprobante = $_POST['num_comprobante'];
$serie = $_POST['serie'];
$subtotal = $_POST['sub_total'];
$descuento = $_POST['descuento'];


if($venta->ValidarVenta2($id_venta)==0){
    $pago = 1;
    $total = $subtotal-$descuento;
    
$venta->EditarVenta($n_comprobante,$serie,$descuento,$total,$pago,$id_venta);

header("Location: ../vistas/venta.php");

}else{

        
    header("Location: ../vistas/venta_editar.php?id=$id_venta&mensaje=existe");

}


}
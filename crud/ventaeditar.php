<?php 

include("../clases/DetalleCuentaC.php");

if(isset($_POST["btnEditarVenta"])){  

$venta = new Venta();
$cuentaporcobrar = new CuentaC();

$id_venta = $_POST['id_venta'];
$n_comprobante = $_POST['num_comprobante'];
$serie = $_POST['serie'];
$subtotal = $_POST['sub_total'];
$descuento = $_POST['descuento'];
$pago = $_POST['pago'];
$id_cliente = $_POST['id_cliente'];

if($venta->ValidarVenta2($id_venta)==0){
    
$total = $subtotal-$descuento;    
$venta->EditarVenta($n_comprobante,$serie,$descuento,$total,$pago,$id_venta);

if($pago == 2){
        $cuentaporcobrar->GuardarCuentaC($id_cliente,$id_venta,$total);
}

header("Location: ../vistas/venta.php");

}else{

        
    header("Location: ../vistas/venta_editar.php?id=$id_venta&mensaje=existe");

}

}

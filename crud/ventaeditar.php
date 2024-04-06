<?php 

include("../clases/Venta.php");

if(isset($_POST["btnEditarVenta"])){  


$venta = new Venta();

$id = $_REQUEST['id'];
$id_cliente = $_POST['id_cliente'];
$id_usuario = $_POST['id_cliente'];
$tipoc = $_POST['tipoc'];
$n_comprobante = $_POST['n_comprobante'];
$serie = $_POST['serie'];
$fecha = $_POST['fecha'];
$total = $_POST['total'];
$pago = $_POST['pago'];

if($venta->ValidarVenta($id_cliente,$n_comprobante)==0){

$empleado->EditarEmpleado($id_cliente,$id_usuario,$tipoc,$n_comprobante,$serie,$fecha,$total,$pago,$id);

header("Location: ../vistas/Venta.php");

}else{

        
    header("Location: ../vistas/venta_editar.php?id=$id&mensaje=existe");

}


}
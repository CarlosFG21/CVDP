<?php

include("../clases/DetalleCuentaC.php");

$id_cobrar = $_POST['id_cobrarc'];
$id_usuario = $_POST['id_usuario'];
$id_venta = $_POST['id_venta'];
$deuda_actual = $_POST['deuda'];
$pago_deuda = $_POST['pago'];

$detallecuentcID = new DetalleCuentaC();


if(isset($_POST["btnGuardarDetallepago"])){
    
  
  if($detallecuentcID->Validarpago($id_cobrar)==0){
  $subtotal = $deuda_actual - $pago_deuda; 
  $detallecuentcID->GuardarDetalleCuentaC($id_cobrar,$id_usuario,$pago_deuda,$deuda_actual);
  
  $id_cobrar2 = $_POST['id_cobrarc'];
  $cuentacID = new CuentaC();
  $cuentacID->EditarCuentac($id_cobrar2,$id_venta,$subtotal);

  header("Location: ../vistas/pagos_creditos.php");

  }else{

  header("Location: ../vistas/pagos_creditos2s.php?mensaje=existe");

  }

}


?>
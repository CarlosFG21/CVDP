<?php

include("../clases/Planilla.php");


$empleado = $_POST['lista1'];
$mes = $_POST['mes'];
$anio = $_POST['anio'];
$tipo = $_POST['tipo'];
$cantidad = $_POST['cantidad'];


$planilla = new Planilla();


if(isset($_POST["btnGuardarPlanilla"])){
    
    if($planilla->ValidarPago($empleado,$mes,$anio)==0){

    $planilla->PagoPlanilla($empleado,$tipo,$cantidad,$mes,$anio);

    header("Location: ../vistas/planilla.php");

}else{

        header("Location: ../vistas/planilla_ingresar.php?mensaje=existe");
    
    }

}



?>
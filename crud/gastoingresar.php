<?php

include("../clases/Gasto.php");


$usuario = 1; 
$tipo = $_POST['gasto'];
$descripcion = $_POST['descripcion'];
$monto = $_POST['monto'];
$fecha = $_POST['fecha'];
$id_empleado = $_POST['empleado'];


$gastoclass = new Gasto();


if(isset($_POST["btnGuardarGasto"])){
    


    $gastoclass->IngresarGato($usuario,$tipo,$descripcion,$monto,$fecha,$id_empleado);

    header("Location: ../vistas/gasto.php");


}


?>
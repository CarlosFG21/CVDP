<?php

include("../clases/Gasto.php");


if(isset($_POST["btnEditarGasto"])){


    $gasto = new Gasto();
    $id = $_REQUEST['id'];
    

    $tipo =  $_POST['tipo'];
    $descripcion =  $_POST['descripcion'];
    $fecha =  $_POST['fecha'];
    $monto =  $_POST['monto'];

    

    $gasto->EditarGasto($tipo,$descripcion,$monto,$fecha,$id);

    header("Location: ../vistas/gasto.php");


}


?>
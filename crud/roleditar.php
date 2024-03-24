<?php

include("../clases/Rol.php");


if(isset($_POST["btnEditarRol"])){


    $rol = new Rol();
    $id = $_REQUEST['id'];
    $mensaje = 1;

    $nombre =  $_POST['rol'];
    $descripcion =  $_POST['descripcion'];

    if($rol->ValidarRol($nombre)==0){

    $rol->EditarRol($nombre,$descripcion,$id);

    header("Location: ../vistas/rol.php");

    }else{

        
        header("Location: ../vistas/rol_editar.php?id=$id&mensaje=existe");
    
    }

}


?>
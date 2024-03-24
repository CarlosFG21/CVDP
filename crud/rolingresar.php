<?php

include("../clases/Rol.php");


$rol = $_POST['rol'];
$descripcion = $_POST['descripcion'];


$rolclass = new Rol();


if(isset($_POST["btnGuardarRol"])){
    

    if($rolclass->ValidarRol($rol)==0){

    $rolclass->GuardarRol($rol,$descripcion);

    header("Location: ../vistas/rol.php");


}else{

    header("Location: ../vistas/rol_ingresar.php?mensaje=existe");

}



}



?>
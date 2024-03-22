<?php

include("../clases/Rol.php");

$rol = $_POST['rol'];
$descripcion = $_POST['descripcion'];

$rolclass = new Rol();


if(isset($_POST["btnGuardarRol"])){


    $rolclass->GuardarRol($rol,$descripcion);

    header("Location: ../vistas/rol.php");


}







?>
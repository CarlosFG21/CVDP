<?php

include("../clases/Rol.php");

$rol = new Rol();
$id = $_REQUEST['id'];

$rol->ReactivarRol($id);

header("Location: ../vistas/rol.php");


?>
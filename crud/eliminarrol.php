<?php

include("../clases/Rol.php");

$rol = new Rol();
$id = $_REQUEST['id'];

$rol->EliminarRol($id);

header("Location: ../vistas/rol.php");


?>
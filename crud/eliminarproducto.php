<?php

include("../clases/Producto.php");

$producto = new Producto();
$id = $_REQUEST['id'];

$producto->EliminarProducto($id);

header("Location: ../vistas/producto.php");


?>
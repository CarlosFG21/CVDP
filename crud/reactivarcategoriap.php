<?php

include("../clases/CategoriaP.php");

$categoria = new Categoriap();
$id = $_REQUEST['id'];

$categoria->ReactivarCategoriap($id);

header("Location: ../vistas/categoria_producto.php");


?>
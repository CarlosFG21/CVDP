<?php

include("../clases/CategoriaP.php");

$nombre = $_POST['categoria'];
$descripcion =$_POST['descripcion'];

$categoria = new Categoriap();

if(isset($_POST["btnGuardarCategoria"])){


    if($categoria->ValidarCategoriap($nombre,$descripcion)==0){


    $categoria->GuardarCategoriaP($nombre,$descripcion);

    header("Location: ../vistas/categoria_producto.php");


}else{

    header("Location: ../vistas/categoria_ingresarp.php?mensaje=existe");

}

}


?>
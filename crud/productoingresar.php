<?php

include("../clases/Producto.php");

$productoclass = new Producto();


if(isset($_POST["btnGuardarProducto"])){

    $categoria = $_POST['categoria'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $cantidad = $_POST['cantidad'];
    $precio = $_POST['precio'];
    $ubicacion = $_POST['ubicacion'];

    if($productoclass->ValidarProducto($nombre)==0){
        $productoclass->GuardarProducto($categoria,$nombre,$descripcion,$cantidad,$precio,$ubicacion);
        header("Location: ../vistas/producto.php");
    }else{
        header("Location: ../vistas/producto_ingresar.php?mensaje=existe");
    }
}


?>
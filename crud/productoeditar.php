<?php

include("../clases/Producto.php");

$producto = new Producto();

if(isset($_POST["btnEditarProducto"])){

    $id = $_POST['id'];
    $categoria = $_POST['categoria'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $cantidad = $_POST['cantidad'];
    $precio = $_POST['precio'];
    $ubicacion = $_POST['ubicacion'];
    $mensaje = 1;

    if($producto->ValidarProducto($nombre)==0){
        $producto->EditarProducto($categoria, $nombre, $descripcion, $cantidad, $precio, $ubicacion, $id);
        header("Location: ../vistas/producto.php");
    }else{
        header("Location: ../vistas/producto_editar.php?id=$id&mensaje=existe");
    }

}


?>
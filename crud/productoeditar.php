<?php

include("../clases/Producto.php");

$producto = new Producto();

if(isset($_POST["btnEditarProducto"])){

    $id = $_POST['id'];
    $categoria = $_POST['categoria'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $cantidad = $_POST['cantidad'];
    $pcompra = $_POST['pcompra'];
    $pventa = $_POST['pventa'];
    $ubicacion = $_POST['ubicacion'];
    $mensaje = 1;
    
    $productoValido = $producto->ValidarProducto($nombre);

    if($productoValido != 0){
        echo "Producto registrado, se puede editar.<br>";
        $producto->EditarProducto($categoria, $nombre, $descripcion, $cantidad, $pcompra, $pventa, $ubicacion, $id);
        header("Location: ../vistas/producto.php");
    } else {
        echo "Producto NO existe, redirigiendo a la edición.<br>";
        header("Location: ../vistas/producto_editar.php?id=$id&mensaje= NO Existe");
    }
}


?>
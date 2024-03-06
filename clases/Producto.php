<?php

include("../db/conexion.php");

class Producto{

public $cantidad;
public $descripcion;
public $estado;
public $id_categoria;
public $id_detalle;
public $id_producto;
public $nombre;
public $precio;
public $ubicacion;

//------------------- creacion de metodos get y set

public function getCantidad(){
    return $this->cantidad;
}

public function setCantidad($_cantidad1){
    $this->cantidad = $_cantidad1;
}

public function getDescripcion(){
    return $this->descripcion;
}

public function setDescripcion($_descripcion1){
    $this->descripcion = $_descripcion1;
}

public function getEstado(){
    return $this->estado;
}

public function setEstado($_estado1){
    $this->estado = $_estado1;
}

public function getIdcategoria(){
    return $this->id_categoria;
}
public function setIdcategoria($_idcategoria){
    $this->id_categoria = $_idcategoria;
}

public function getIdetalle(){
    return $this->id_detalle;
}

public function setIdetalle($_idetalle){
    $this->id_detalle = $_idetalle;
}

public function getIdproducto(){
    return $this->id_producto;
}

public function setIdproducto($_idproducto){
    $this->id_producto = $_idproducto;
}

public function getNombre(){
    return $this->nombre;
}
public function setNombre($_nombre1){
    $this->nombre = $_nombre1;
}
public function getPrecio(){
    return $this->precio;
}

public function setPrecio($_precio1){
    $this->precio = $_precio1;
}

public function getUbicacion(){
    return $this->ubicacion;
}

public function setUbicacion($_ubicacion1){
    $this->ubicacion = $_ubicacion1;
}
}


?>
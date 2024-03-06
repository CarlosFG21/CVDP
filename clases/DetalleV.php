<?php

include("../db/conexion.php");

class DetalleV{

public $cantidad;
public $cantidad_medida;
public $descuento;
public $estado;
public $id_detallev;
public $id_producto;
public $id_venta;
public $unidad_medida;

public function getCantidad(){
    return $this->cantidad;
}
public function setCantidad($_cantidad1){
    $this->cantidad = $_cantidad1;
}


public function getCantidadm(){
    return $this->cantidad_medida;
}
public function setCantidadm($_cantidadm){
    $this->cantidad_medida = $_cantidadm;
}


public function getDescuento(){
    $this->descuento;
}
public function setDescuento($_descuento1){
    $this->descuento = $_descuento1;
}


public function getEstado(){
    return $this->estado;
}
public function setEstado($_estado1){
    $this->estado = $_estado1;
}


public function getIdetallev(){
    return $this->id_detallev;
}
public function setIdetallev($_idetallev){
    $this->id_detallev = $_idetallev;
}


public function getIdproducto(){
    return $this->id_producto;
}
public function setIdproducto($_idproducto){
    $this->id_producto = $_idproducto;
}


public function getIdventa(){
    return $this->id_venta;
}
public function setIdventa($_idventa){
    $this->id_venta = $_idventa;
}


public function getUnidadm(){
    return $this->unidad_medida;
}
public function setUnidadm($_unidadm){
    $this->unidad_medida = $_unidadm;
}



}


?>
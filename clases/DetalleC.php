<?php

include("../db/conexion.php");

class DetalleC{

public $cantidad;
public $cantidad_medida;
public $estado;
public $id_compra;
public $id_detallecompra;
public $id_producto;
public $unidad_medida;

public function getCantidad(){
    return $this->cantidad;
}
public function setCantidad($_cantidad1){
    $this->cantidad = $_cantidad1;
}


public function getCantidadM(){
    return $this->cantidad_medida;
}
public function setCantidadM($_cantidadm){
    $this->cantidad_medida = $_cantidad1;
}


public function getEstado(){
    return $this->estado;
}
public function setEstado($_estado1){
    $this->estado = $_estado1;
}


public function getIdcompra(){
    return $this->id_compra;
}
public function setIdcompra($_idcompra){
    $this->id_compra = $_idcompra;
}


public function getIdetalle(){
    return $this->id_detallecompra;
}
public function setIdetalle($_idetallec){
    $this->id_detallecompra = $_idetallec;
}


public function getIdproducto(){
    return $this->id_producto;
}
public function setIdproducto($_idproducto){
    $this->id_producto = $_idproducto;
}


public function getUnidadm(){
    return $this->unidad_medida;
}
public function setUnidadm($_unidadm){
    $this->unidad_medida = $_unidadm;
}


}


?>
<?php

include("../db/conexion.php");

class Compra{

public $estado;
public $fecha;
public $id_compra;
public $id_proveedor;
public $id_usuario;
public $impuesto;
public $n_comprobante;
public $serie_c;
public $tipo_c;
public $total;

//----------------------- creacion de metodo get y set-------------------------------
public function getEstado(){
    return $this->estado;
}

public function setEstado($_estado1){
    $this->estado = $_estado1;
}

public function getFecha(){
    return $this->fecha;
}
public function setFecha($_fecha1){
    $this->fecha = $_fecha1;
}

public function getIdcompra(){
    return $this->id_compra;
}
public function setIdcompra($_idcompra){
    $this->id_compra = $_idcompra;
}


public function getIdproveedor(){
    return $this->id_proveedor;
}
public function setIdproveedor($_idproveedor){
    $this->id_proveedor = $_idproveedor;
}


public function getIdusuario(){
    return $this->id_usuario;
}
public function setIdusuario($_idusuario){
    $this->id_usuario = $_idusuario;
}


public function getImpuesto(){
    return $this->impuesto;
}
public function setImpuesto($_impuesto1){
    $this->impuesto = $_impuesto1;
}


public function getComprobante(){
    return $this->n_comprobante;
}
public function setComprobante($_ncomprobante){
    $this->n_comprobante = $_ncomprobante;
}


public function getSerie(){
    return $this->serie_c;
}
public function setSerie($_serie1){
    $this->serie_c = $_serie1;
}

public function getTipo(){
    return $this->tipo_c;
}
public function setTipo($_tipo1){
    $this->tipo_c = $_tipo1;
}


public function getTotal(){
    return $this->total;
}
public function setTotal($_total1){
    $this->total = $_total1;
}


}



?>
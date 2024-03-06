<?php

include("../db/conexion.php");

class Venta{


    public $estado;
    public $fecha;
    public $id_cliente;
    public $id_usuario;
    public $id_venta;
    public $impuesto;
    public $n_comprobante;
    public $pago;
    public $serie;
    public $tipoc;
    public $total;


    //--------------------------- creacion de meto get y set

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

    public function getIdcliente(){
        return $this->id_cliente;
    }

    public function setIdcliente($_idcliente){
        $this->id_cliente = $_idcliente;
    }

    public function getIdusuario(){
        return $this->id_usuario;
    }
    public function setIdusuario($_idusuario){
        $this->id_usuario = $_idusuario;
    }

    public function getIdventa(){
        return $this->id_venta;
    }

    public function setIdventa($_idventa){
        $this->id_venta = $_idventa;
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

    public function getPago(){
        return $this->pago;
    }

    public function setPago($_pago1){
        $this->pago = $_pago1;
    }

    public function getSerie(){
        return $this->serie;
    }

    public function setSerie($_serie1){
        $this->serie = $_serie1;
    }

    public function getTipoc(){
        return $this->tipoc;
    }

    public function setTipoc($_tipoc1){
        $this->tipoc = $_tipoc1;
    }

    public function getTotal(){
        return $this->total;
    }

    public function setTotal($_total1){
        $this->total = $_total1;
    }



}


?>
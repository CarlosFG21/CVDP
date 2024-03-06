<?php

include("../db/conexion.php");


class CuentaC{


    public $estado;
    public $id_cliente;
    public $id_cobrar;
    public $id_venta;


    //--------------------------- creacion del metod get y set -----------------------------------

    public function getEstado(){
        return $this->estado;
    }

    public function setEstado($_estado1){
        $this->estado = $_estado1;
    }


    public function getIdcliente(){
        return $this->id_cliente;
    }

    public function setIdcliente($_idcliente1){
        $this->id_cliente = $_idcliente1;
    }

    public function getIdcobrar(){
        return $this->id_cobrar;
    }

    public function setIdcobrar($_idcobrar1){
        $this->id_cobrar = $_idcobrar1;
    }

    public function getIdventa(){
        return $this->id_venta;
    }

    public function setIdventa($_idventa1){
        $this->id_venta = $_idventa1;
    }



}


?>
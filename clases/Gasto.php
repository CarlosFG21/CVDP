<?php

include("../db/conexion.php");

class Gasto{


    public $descripcion;
    public $estado;
    public $id_gasto;
    public $id_usuario;
    public $monto;
    public $tipo;


    //------------- creacion de meto get y set--------------------------------------

    public function getDescriocion(){
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

    public function getIdgasto(){
        return $this->id_gasto;
    
    }

    public function setIdgasto($_idgasto1){
        $this->id_gasto = $_idgasto1;
    }

    public function getIdusuario(){
        return $this->id_usuario;
    }

    public function setIdusuario($_idusuario1){
        $this->id_usuario = $_idusuario1;
    }

    public function getMonto(){
        return $this->monto;
    }

    public function setMonto($_monto1){
        $this->monto = $_monto1;
    }

    public function getTipo(){
        return $this->tipo;
    }

    public function setTipo($_tipo1){
        $this->tipo = $_tipo1;
    }


}


?>
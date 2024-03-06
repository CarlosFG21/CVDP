<?php

include("../db/conexion.php");

class Usuario{


    public $clave;
    public $estado;
    public $idrol;
    public $idusuario;
    public $nombre;

    //creacion de los metodos get y set


    //----------------------------------------------------------------------------------

    //metodo get y set clave

    public function getClave(){
        return $this->clave;
    }

    public function setClave($_clave1){
        $this->clave = $_clave1;
    }


    //----------------------------------------------------------------------------------
    
    //metodo get y set estado

    public function getEstado(){
        return $this->estado;
    }

    public function setEstado($_estado1){
        $this->estado = $_estado1;
    }


    //---------------------------------------------------------------------------

    //metodo get y set id rol

    public function getIdrol(){
       return $this->idrol;
    }

    public function setIdrol($_idrol1){
        $this->idrol = $_idrol1;
    }

    //-----------------------------------------------------------------------------

    //metodo get y set id usuario

    public function getIdusuario(){

        return $this->idusuario;
    }

    public function setIdusuario($_idusuario1){
        $this->idusuario = $_idusuario1;
    
    }

    //------------------------------------------------------------------------------------
     

    //metodo get y set nombre 

    public function getNombre(){
        return $this-> nombre;

    }

    public function setNombre($_nombre1){
        $this->nombre = $_nombre1;
    }


    //Creacion de funciones para login, registro, edicion, visualizacion y eliminacion de usuarios

    




}




?>
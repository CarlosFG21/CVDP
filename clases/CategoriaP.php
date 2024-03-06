<?php

include("../db/conexion.php");

class Categoriap{

    public $descripcion;
    public $estado;
    public $id_categotia;
    public $nombre;

    //---------------------- creacion de metodo get y set--------------------------------------------

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

    public function getNombre(){
        return $this->nombre;
    }

    public function setNombre($_nombre1){
        $this->nombre = $_nombre1;
    }
}


?>
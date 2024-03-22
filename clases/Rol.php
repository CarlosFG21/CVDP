<?php

include("../db/conexion.php");


class Rol{

    public $descripcion;
    public $estado;
    public $id_rol;
    public $nombre;

    //creacion de metodos get y set---------------------------------------------

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

    public function getIdrol(){
        return $this->id_rol;
    }

    public function setIdrol($_id_rol1){
        $this->id_rol = $_id_rol1;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function setNombre($_nombre1){
        $this->nombre = $_nombre1;
    }

    //--------------------------------------------------------------------------------------------------------------------------------
    //funcion guardar rol

    public function GuardarRol($rol,$descripcion){
        
        $conexion = new conexion();

        $conexion->conectar();

        $sql = "insert into rol(nombre,descripcion) values(?,?)";

        $ejecutar = $conexion->db->prepare($sql);

        $ejecutar->bind_param('ss',$rol,$descripcion);

        $ejecutar->execute();
        
        $conexion->desconectar();
    }


}



?>
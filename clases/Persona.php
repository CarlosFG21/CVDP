<?php

include("../db/conexion.php");

class Persona{


    public $estado;
    public $id_persona;
    public $nit;
    public $nombre;


    //---------------------- creacion del metodo get y set ---------------------------------------

    public function getEstado(){
        return $this->estado;
    }

    public function setEstado($_estado1){
        $this->estado = $_estado1;
    }

    public function getIdpersona(){
        return $this->id_persona;
    }

    public function setIdpersona($_idpersona1){
        $this->id_persona = $_idpersona1;
    }

    public function getNit(){
        return $this->nit;
    }

    public function setNit($_nit1){
        $this->nit = $_nit1;
    }


    public function getNombre(){
        return $this->nombre;
    }

    public function setNombre($_nombre1){
        $this->nombre = $_nombre1;
    }

    public function guardar($nit,$nombre,$estado=1){
        $conexion = new conexion();

        $conexion->conectar();

        $sql = "insert into persona(nit,nombre,estado) values(?,?,?)";
 
        $ejecutar = $conexion->db->prepare($sql);

        $ejecutar->bind_param('ssi',$nit,$nombre,$estado);

        $ejecutar->execute();
        
        $conexion->desconectar();
    }



}



?>
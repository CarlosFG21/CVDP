<?php

include("../db/conexion.php");

class Empleado{

    public $apellido;
    public $edad;
    public $estado;
    public $fecha_ent;
    public $id_empleado;
    public $id_usuario;
    public $nombre;
    public $puesto;
    public $salario;

    public function getApellido(){
        return $this->apellido;
    }

    public function setApellido($_apellido1){
        $this->apellido = $_apellido1;
    }


    public function getEdad(){
        return $this->edad;
    }

    public function setEdad($_edad1){
        $this->edad = $_edad1;
    }


    public function getEstado(){
        return $this->estado;
    }
    public function setEstado($_estado1){
        $this->estado = $_estado1;
    }


    public function getFecha(){
        return $this->fecha_ent;
    }
    public function setFecha($_fecha){
        $this->fecha_ent = $_fecha;
    }


    public function getIdempleado(){
        return $this->id_empleado;
    }
    public function setIdempleado($_idempleado){
        $this->id_empleado = $_idempleado;
    }


    public function getIdusuario(){
        return $this->id_usuarioa;
    }
    public function setIdusuario($_idusuario){
        $this->id_usuario = $_idusuario;
    }


    public function getNnombre(){
        return $this->nombre;
    }
     public function setNombre($_nombre1){
        $this->nombre = $_nombre1;
     }


     public function getPuesto(){
        return $this->puesto;
     }

     public function setPuesto($_puesto1){
        $this->puesto = $_puesto1;
     }

     public function getSalario(){
        return $this->salario;
     }

    public function setSalario($_salario1){
        $this->salario = $_salario1;
    }


}


?>
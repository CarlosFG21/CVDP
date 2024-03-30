<?php

include("../db/conexion.php");

class Persona{


    public $estado;
    public $id_persona;
    public $nit;
    public $nombre;
    public $tipo;


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

    public function getTipo(){  
        return $this->tipo;
    }

    public function setTipo($_tipo1){
        $this->tipo = $_tipo1;
    }
    //------------------------------------------------------------------------------------------------------------------
    //Funcion guardar clientes/proveedor

    public function GuardarPersona($tipo,$nombre,$nit){

        $conexion = new conexion();

        $conexion->conectar();

        $sql = "insert into persona(tipo,nombre,nit) values(?,?,?)";
 
        $ejecutar = $conexion->db->prepare($sql);

        $ejecutar->bind_param('ssi',$tipo,$nombre,$nit);

        $ejecutar->execute();
        
        $conexion->desconectar();
    }

    //--------------------------------------------------------------------------------------------------------------------
    //Funcion mostrar los clientes y proveedores

    public function ObtenerPersonas(){

     $conexion = new conexion();

     $conexion->conectar();

     $personaob = array();

     $sql = "SELECT * FROM persona";

     $ejecutar = mysqli_query($conexion->db,$sql);

     while($fila = mysqli_fetch_array($ejecutar)){

        $personaIndex = new Persona();

         $personaIndex->setIdpersona($fila[0]);
         $personaIndex->setNombre($fila[1]);
         $personaIndex->setNit($fila[2]);
         $personaIndex->setEstado($fila[3]);
         $personaIndex->setTipo($fila[4]);

         array_push($personaob,$personaIndex);

    }

    $conexion->desconectar();
    
    return $personaob;


    }




}



?>
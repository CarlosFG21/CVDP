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
        $estado=1;
        $sql = "insert into persona(tipo,nombre,nit,estado) values(?,?,?,?)";
 
        $ejecutar = $conexion->db->prepare($sql);

        $ejecutar->bind_param('ssii',$tipo,$nombre,$nit,$estado);
        

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

    //-----------------------------------------------------------------------------------------------------------------------------------
    //Funcion Editar Persona

    public function EditarPersona($tipo,$nombre,$nit,$idpersona){ 


        $conexion = new conexion();

        $conexion->conectar();

        $sql = "update persona set nombre=?, nit=?, tipo=? where id_persona=?";

        $ejecutar = $conexion->db->prepare($sql);

        $ejecutar->bind_param('sssi',$nombre,$nit,$tipo,$idpersona);

        $ejecutar->execute();

        $conexion->desconectar();

    }


    //------------------------------------------------------------------------------------------------------------------
    //Funcion para buscar las personas

    public function BuscarPersona($idpersona){

        $conexion = new conexion();

        $conexion->conectar();

        $personaArray = new Persona();
        
        $sql = "select * from persona where id_persona=?";

        $ejecutar = $conexion->db->prepare($sql);

        $ejecutar->bind_param('i',$idpersona);

        $ejecutar->execute();

        $resultado = $ejecutar->get_result();

        while($fila = $resultado->fetch_array(MYSQLI_NUM)){


            $personaArray->setIdpersona($fila[0]);
            $personaArray->setNombre($fila[1]);
            $personaArray->setNit($fila[2]);
            $personaArray->setEstado($fila[3]);
            $personaArray->setTipo($fila[4]);
        

        }

        $conexion->desconectar();

        return $personaArray;

    }

    //-----------------------------------------------------------------------------------------------------------------------------------
    //Funcion eliminar persona

    public function EliminarPersona($idpersona){


        $conexion = new conexion();

        $conexion->conectar();

        $estado = 0;

        $sql = "update persona set estado=? where id_persona=?";

        $ejecutar = $conexion->db->prepare($sql);

        $ejecutar->bind_param('ii',$estado,$idpersona);

        $ejecutar->execute();

        $conexion->desconectar();


    }

    //-----------------------------------------------------------------------------------------------------------------------------------------
    //Funcion reactivar persona

    public function  ReactivarPersona($idpersona){


        $conexion = new conexion();

        $conexion->conectar();

        $estado = 1;

        $sql = "update persona set estado=? where id_persona=?";

        $ejecutar = $conexion->db->prepare($sql);

        $ejecutar->bind_param('ii',$estado,$idpersona);

        $ejecutar->execute();

        $conexion->desconectar();


    }

    public function ValidarPersona($nombre,$tipo){   


        $conexion = new conexion();

        $conexion->conectar();

        $estado = 0;

        $sql = "select nombre,tipo from persona where nombre=? and tipo=?";

        $ejecutar = $conexion->db->prepare($sql);
        $ejecutar->bind_param('ss', $nombre,$tipo);
        $ejecutar->execute();
    
        $resultado = $ejecutar->get_result();

        while($fila = $resultado->fetch_array(MYSQLI_NUM)){
            if(strcmp($fila[0],$nombre)===0 && strcmp($fila[1],$tipo)===0){
                $estado=1;
                break;
            }
        }

        $conexion->desconectar();

        return $estado;
    }



}



?>
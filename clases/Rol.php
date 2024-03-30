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

    //--------------------------------------------------------------------------------------------------------------------------------------------

    //funcion visualizar roles

    public function ObtenerRoles(){
        
        $conexion = new conexion();

        $conexion->conectar();

        $resultadoRol = array();
        
        $sql = "SELECT * FROM rol";

        $ejecutar = mysqli_query($conexion->db,$sql);

        while($fila = mysqli_fetch_array($ejecutar)){

            $rolIndex = new Rol();

             $rolIndex->setIdrol($fila[0]);
             $rolIndex->setNombre($fila[1]);
             $rolIndex->setDescripcion($fila[2]);
             $rolIndex->setEstado($fila[3]);

             array_push($resultadoRol,$rolIndex);

        }

        $conexion->desconectar();
        
        return $resultadoRol;
    }

    //---------------------------------------------------------------------------------------------------------------------
    ///funcion editar rol

    public function EditarRol($nombrerol,$descripcionrol,$idrol1){

      $conexion = new conexion();

      $conexion->conectar();

      $sql = "update rol set nombre=?, descripcion=? where id_rol=?";

      $ejecutar = $conexion->db->prepare($sql);

      $ejecutar->bind_param('ssi',$nombrerol,$descripcionrol,$idrol1);

      $ejecutar->execute();

      $conexion->desconectar();

    }


    public function BuscarRol($idrol){


        $conexion = new conexion();

        $conexion->conectar();

        $rolArray = new Rol();
        
        $sql = "select * from rol where id_rol=?";

        $ejecutar = $conexion->db->prepare($sql);
        $ejecutar->bind_param('i', $idrol);
        $ejecutar->execute();
    
        $resultado = $ejecutar->get_result();

        while($fila = $resultado->fetch_array(MYSQLI_NUM)){

            $rolArray->setIdrol($fila[0]);
            $rolArray->setNombre($fila[1]);
            $rolArray->setDescripcion($fila[2]);
            $rolArray->setEstado($fila[2]);


        }

        $conexion->desconectar();

        return $rolArray;


    }
    
    //----------------------------------------------------------------------------------------------------------
    //Funcion eliminar rol

    public function EliminarRol($idrol){


        $conexion = new conexion();

        $conexion->conectar();

        $estado = 0;

        $sql = "update rol set estado=? where id_rol=?";

        $ejecutar = $conexion->db->prepare($sql);

        $ejecutar->bind_param('ii',$estado, $idrol);

        $ejecutar->execute();

        $conexion->desconectar();

    }

    public function ReactivarRol($idrol){

     $conexion = new conexion();

     $conexion->conectar();

     $estado = 1;

     $sql = "update rol set estado=? where id_rol=?";

     $ejecutar = $conexion->db->prepare($sql);

     $ejecutar->bind_param('ii',$estado, $idrol);

     $ejecutar->execute();

     $conexion->desconectar();


    }

    public function ValidarRol($rolv){   


        $conexion = new conexion();

        $conexion->conectar();

        $estado = 0;

        $sql = "select nombre from rol where nombre=?";

        $ejecutar = $conexion->db->prepare($sql);
        $ejecutar->bind_param('s', $rolv);
        $ejecutar->execute();
    
        $resultado = $ejecutar->get_result();

        while($fila = $resultado->fetch_array(MYSQLI_NUM)){
            if(strcmp($fila[0],$rolv)===0){
                $estado=1;
                break;
            }
        }

        $conexion->desconectar();

        return $estado;
    }


}



?>
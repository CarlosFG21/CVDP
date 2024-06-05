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

    //-------------------------------------------------------------------------------------------------------------------------------
    //Funcion guardar categoria de productos

    public function GuardarCategoriaP($nombre,$descripcion){ 

        $conexion = new conexion();

        $conexion->conectar();

        $sql = "insert into categoria_producto(nombre,descripcion) values(?,?)";

        $ejecutar = $conexion->db->prepare($sql);

        $ejecutar->bind_param('ss',$nombre,$descripcion);

        $ejecutar->execute();

        $conexion->desconectar();


    }

    //--------------------------------------------------------------------------------------------------------------------------------

    public function ObtenerCategoriap(){  


        $conexion = new conexion();

        $conexion->conectar();
        
        $categoriap = array();

        $sql = "SELECT * FROM categoria_producto";

        $ejecutar = mysqli_query($conexion->db,$sql);

        while($fila= mysqli_fetch_array($ejecutar)){


               $Indexarray = new Categoriap();

               $Indexarray->setIdcategoria($fila[0]);
               $Indexarray->setNombre($fila[1]);
               $Indexarray->setDescripcion($fila[2]);
               $Indexarray->setEstado($fila[3]);

               array_push($categoriap,$Indexarray);

        }

        $conexion->desconectar();

        return $categoriap;

    }

    //-------------------------------------------------------------------------------------------------------------
    //funcion visualizar categorias.
    public function BuscarCategoria($idcategoria){

      $conexion = new conexion();

      $conexion->conectar();

      $categop = new Categoriap();

      $sql = "select * from categoria_producto where id_categoria=?";

      $ejecutar = $conexion->db->prepare($sql);
        $ejecutar->bind_param('i', $idcategoria);
        $ejecutar->execute();
    
        $resultado = $ejecutar->get_result();

      while($fila= $resultado->fetch_array(MYSQLI_NUM)){

        $categop->setIdcategoria($fila[0]);
        $categop->setNombre($fila[1]);
        $categop->setDescripcion($fila[2]);
        $categop->setEstado($fila[3]);


      }

      $conexion->desconectar();

      return $categop;

    }

    //-------------------------------------------------------------------------------------------------------------------------
    //Funcion editar categoria producto

    public function EditarCategotia($nombre,$descripcion,$idcategoria){

        $conexion = new conexion();

        $conexion->conectar();

        $sql = "update categoria_producto set nombre=?, descripcion=? where id_categoria=?";

        $ejecutar = $conexion->db->prepare($sql);

        $ejecutar->bind_param('ssi',$nombre,$descripcion,$idcategoria);

        $ejecutar->execute();

        $conexion->desconectar();


    }


    //-----------------------------------------------------------------------------------------------------------------------
    //Funcion eliminar categoria producto

    public function EliminarCategoriap($idcategoria){

        $conexion = new conexion();

        $conexion->conectar();

        $estado=0;

        $sql = "update categoria_producto set estado=? where id_categoria=?";

        $ejecutar = $conexion->db->prepare($sql);

        $ejecutar->bind_param('ii',$estado,$idcategoria);

        $ejecutar->execute();

        $conexion->desconectar();

    }


    public function ReactivarCategoriap($idcategoria){

        $conexion = new conexion();

        $conexion->conectar();

        $estado=1;

        $sql = "update categoria_producto set estado=? where id_categoria=?";

        $ejecutar = $conexion->db->prepare($sql);

        $ejecutar->bind_param('ii',$estado,$idcategoria);

        $ejecutar->execute();

        $conexion->desconectar();

    }

    //----------------------------------------------------------------------------------------------
    // Funcion validar categoria de producto

    public function ValidarCategoriap($categoriapv,$descripcionp){   


        $conexion = new conexion();

        $conexion->conectar();

        $estado = 0;

        $sql = "select nombre,descripcion from categoria_producto where nombre=? and descripcion=?";

        $ejecutar = $conexion->db->prepare($sql);
        $ejecutar->bind_param('ss', $categoriapv,$descripcionp);
        $ejecutar->execute();
    
        $resultado = $ejecutar->get_result();

        while($fila = $resultado->fetch_array(MYSQLI_NUM)){
            if(strcmp($fila[0],$categoriapv)===0 && strcmp($fila[1],$descripcionp)===0){
                $estado=1;
                break;
            }
        }

        $conexion->desconectar();

        return $estado;
    }




}


?>
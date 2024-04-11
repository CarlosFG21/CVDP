<?php

include("../db/conexion.php");

class Gasto{


    public $descripcion;
    public $estado;
    public $id_gasto;
    public $id_usuario;
    public $monto;
    public $tipo;
    public $fecha;
    public $id_empleado;
    public $nombre;
    public $apellido;


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

    public function getFecha(){
        return $this->fecha;
    }

    public function setFecha($fecha_g){
        $this->fecha = $fecha_g;
    }

    public function getIdempleado(){
        return $this->id_empleado;
    }

    public function setIdempleado($idempleado){
        $this->id_empleado = $id_empleado;
    }

    public function getNombre(){ 

        return $this->nombre;

    }

    public function setNombre($nombre1){ 

        $this->nombre = $nombre1;


    }

    public function getApellido(){ 

        return $this->apellido;

    }

    
    public function setApellido($apellido1){ 

        $this->apellido = $apellido1;


    }

    //------------------------------------------------------------------------------------------------------------------------------
    //Funcion ingresar gastos

    public function IngresarGato($idusuario,$tipo,$descripcion,$monto,$fecha,$id_empleado){   

        $conexion = new conexion();

        $conexion->conectar();

        $sql = "insert into gastos(id_usuario,tipo_gasto,descripcion,monto,fecha,id_empleado) values(?,?,?,?,?,?)";

        $ejecutar = $conexion->db->prepare($sql);

        $ejecutar->bind_param('issssi',$idusuario,$tipo,$descripcion,$monto,$fecha,$id_empleado);

        $ejecutar->execute();

        $conexion->desconectar();

    }

    //------------------------------------------------------------------------------------------
    //Obtner gastos
    public function ObtenerGastos(){
        
        $conexion = new conexion();

        $conexion->conectar();

        $resultadoGasto = array();
        
        $sql = "SELECT empleado.Nombre,empleado.Apellido, gastos.Id_Gasto, gastos.Tipo_Gasto,gastos.Descripcion, gastos.fecha,gastos.Monto, gastos.Estado FROM empleado INNER JOIN gastos ON empleado.id_empleado = gastos.id_empleado";

        $ejecutar = mysqli_query($conexion->db,$sql);

        while($fila = mysqli_fetch_array($ejecutar)){

            $gasIndex = new Gasto();

            $gasIndex->setNombre($fila[0]);
            $gasIndex->setApellido($fila[1]);
            $gasIndex->setIdgasto($fila[2]);
            $gasIndex->setTipo($fila[3]);
            $gasIndex->setDescripcion($fila[4]);
            $gasIndex->setFecha($fila[5]);
            $gasIndex->setMonto($fila[6]);
            $gasIndex->setEstado($fila[7]);

             array_push($resultadoGasto,$gasIndex);

        }

        $conexion->desconectar();
        
        return $resultadoGasto;
    }

    //---------------------------------------------------------------------------------------------------------------------------
    //Funcion visualizar
    public function BuscarGasto($idgasto){


        $conexion = new conexion();

        $conexion->conectar();

        $gastoArray = new Gasto();
        
        $sql = "SELECT empleado.Nombre,empleado.Apellido, gastos.Id_Gasto, gastos.Tipo_Gasto,gastos.Descripcion, gastos.fecha,gastos.Monto, gastos.Estado FROM empleado INNER JOIN gastos ON empleado.id_empleado = gastos.id_empleado where gastos.id_gasto=?";

        $ejecutar = $conexion->db->prepare($sql);
        $ejecutar->bind_param('i', $idgasto);
        $ejecutar->execute();
    
        $resultado = $ejecutar->get_result();

        while($fila = $resultado->fetch_array(MYSQLI_NUM)){


            $gastoArray->setNombre($fila[0]);
            $gastoArray->setApellido($fila[1]);
            $gastoArray->setIdgasto($fila[2]);
            $gastoArray->setTipo($fila[3]);
            $gastoArray->setDescripcion($fila[4]);
            $gastoArray->setFecha($fila[5]);
            $gastoArray->setMonto($fila[6]);
            $gastoArray->setEstado($fila[7]);


        }

        $conexion->desconectar();

        return  $gastoArray;


    }

    //--------------------------------------------------------------------------------------------------------------------------
    //Funcion editar gasto

    public function EditarGasto($tipo,$descripcion,$monto,$fecha,$id_gasto){ 

    

            $conexion = new conexion();
    
            $conexion->conectar();
    
            $sql = "update gastos set tipo_gasto=?, descripcion=?, monto=?, fecha=? where id_gasto=?";
    
            $ejecutar = $conexion->db->prepare($sql);
    
            $ejecutar->bind_param('ssisi',$tipo,$descripcion,$monto,$fecha,$id_gasto);
    
            $ejecutar->execute();
    
            $conexion->desconectar();
    
    


    }

    //------------------------------------------------------------------------------------------------------------------------
    


}


?>
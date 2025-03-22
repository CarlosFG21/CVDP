<?php

include("../clases/Persona.php");

class cotizacion{

    public $estado;
    public $fecha;
    public $id_cliente;
    public $id_usuario;
    public $id_cotizacion;
    public $descuento;
    public $pago_instalacion;
    public $descripcion;
    public $total;

    //--------------------------- creacion de meto get y set

    public function getEstado(){
        return $this->estado;
    }

    public function setEstado($_estado1){
        $this->estado = $_estado1;
    }

    public function getFecha(){
        return $this->fecha;
    }

    public function setFecha($_fecha1){
        $this->fecha = $_fecha1;
    }

    public function getIdcliente(){
        return $this->id_cliente;
    }

    public function setIdcliente($_idcliente){
        $this->id_cliente = $_idcliente;
    }

    public function getIdusuario(){
        return $this->id_usuario;
    }
    public function setIdusuario($_idusuario){
        $this->id_usuario = $_idusuario;
    }

    public function getIdcotizacion(){
        return $this->id_cotizacion;
    }

    public function setIdcotizacion($_idcotizacion){
        $this->id_cotizacion = $_idcotizacion;
    }

    public function getDescripcion(){
        return $this->descripcion;
    }

    public function setDescripcion($_descripcion){
        $this->descripcion = $_descripcion;
    }

    public function getDescuento(){
        return $this->descuento;
    }

    public function setDescuento($_descuento1){
        $this->descuento = $_descuento1;
    }

    public function getPagoinstalacion(){
        return $this->pago_instalacion;
    }

    public function setPagoinstalacion($_pago_instalacion1){
        $this->pago_instalacion = $_pago_instalacion1;
    }
    public function getTotal(){
        return $this->total;
    }

    public function setTotal($_total1){
        $this->total = $_total1;
    }

    //------------------------------------------------------------------------------------------------------------------
    //Funcion Guardar Informacion Empleado 

    public function GuardarCotizacion($id_cliente,$id_usuario,$descripcion,$descuento,$pago_instalacion,$total){

        $conexion = new conexion();

        $conexion->conectar();
        $estado = 1;
        $sql = "insert into cotizacion(Id_Cliente,Id_Usuario,Descripcion,Descuento,Pago_Envio_Instalacion,Total, Estado) values(?,?,?,?,?,?,?)";
 
        $ejecutar = $conexion->db->prepare($sql);
        
        $ejecutar->bind_param('iisdddi',$id_cliente,$id_usuario,$descripcion,$descuento,$pago_instalacion,$total,$estado);

        $ejecutar->execute();
        
        $conexion->desconectar();
    }
    //------------FUNCION DE EDITAR COTIZACION-----------------------
    public function EditarCotizacion($descuento,$pago_instalacion,$total,$id_cotizacion){ 

        $conexion = new conexion();

        $conexion->conectar();

        $sql = "update cotizacion set Descuento=?, Pago_Envio_Instalacion=?, Total=? where id_cotizacion=?";

        $ejecutar = $conexion->db->prepare($sql);

        $ejecutar->bind_param('dddi',$descuento,$pago_instalacion,$total,$id_cotizacion);

        $ejecutar->execute();

        $conexion->desconectar();

    }
    //--------------------------------------------------------------------------------------------------------------------
    //Funcion mostrar los empleados registrados

    public function ObtenerCotizacion(){

     $conexion = new conexion();

     $conexion->conectar();

     $cotizacionob = array();

     $sql = "SELECT * FROM cotizacion";

     $ejecutar = mysqli_query($conexion->db,$sql);

     while($fila = mysqli_fetch_array($ejecutar)){

        $cotizacionIndex = new cotizacion();

            $cotizacionIndex->setIdcotizacion($fila[0]);
            $cotizacionIndex->setIdcliente($fila[1]);
            $cotizacionIndex->setIdusuario($fila[2]);
            $cotizacionIndex->setDescripcion($fila[3]);
            $cotizacionIndex->setFecha($fila[4]);
            $cotizacionIndex->setDescuento($fila[5]);
            $cotizacionIndex->setPagoinstalacion($fila[6]);
            $cotizacionIndex->setTotal($fila[7]);
            $cotizacionIndex->setEstado($fila[8]);
            
         array_push($cotizacionob,$cotizacionIndex);

    }

    $conexion->desconectar();
    
    return $cotizacionob;


    }


    //------------------------------------------------------------------------------------------------------------------
    //Funcion para buscar los empleados

    public function BuscarCotizacion($id_cotizacion){

        $conexion = new conexion();

        $conexion->conectar();

        $cotizacionArray = new cotizacion();
        
        $sql = "select * from cotizacion where id_cotizacion=?";

        $ejecutar = $conexion->db->prepare($sql);

        $ejecutar->bind_param('i',$id_cotizacion);

        $ejecutar->execute();

        $resultado = $ejecutar->get_result();

        while($fila = $resultado->fetch_array(MYSQLI_NUM)){

            $cotizacionArray->setIdcotizacion($fila[0]);
            $cotizacionArray->setIdcliente($fila[1]);
            $cotizacionArray->setIdusuario($fila[2]);
            $cotizacionArray->setDescripcion($fila[3]);
            $cotizacionArray->setFecha($fila[4]);
            $cotizacionArray->setDescuento($fila[5]);
            $cotizacionArray->setPagoinstalacion($fila[6]);
            $cotizacionArray->setTotal($fila[7]);
            $cotizacionArray->setEstado($fila[8]);

        }

        $conexion->desconectar();

        return $cotizacionArray;

    }

    //-----------------------------------------------------------------------------------------------------------------------------------
    //Funcion eliminar empleado o desactivarlo

    public function EliminarCotizacion($id_cotizacion){

        $conexion = new conexion();
        $conexion->conectar();

        $estado = 0;
        $sql = "update cotizacion set estado=? where id_cotizacion=?";

        $ejecutar = $conexion->db->prepare($sql);

        $ejecutar->bind_param('ii',$estado,$id_cotizacion);
        $ejecutar->execute();

        $conexion->desconectar();

    }

    //-----------------------------------------------------------------------------------------------------------------------------------------
    //Funcion reactivar a empleado

    public function  ReactivarCotizacion($id_cotizacion){

        $conexion = new conexion();
        $conexion->conectar();

        $estado = 1;
        $sql = "update cotizacion set estado=? where id_cotizacion=?";

        $ejecutar = $conexion->db->prepare($sql);

        $ejecutar->bind_param('ii',$estado,$id_cotizacion);
        $ejecutar->execute();
        $conexion->desconectar();

    }

    public function ValidarCotizacion($id_cliente,$id_usuario){   

        $conexion = new conexion();
        $conexion->conectar();

        $estado = 0;
        $sql = "select Id_Cliente,Id_Usuario from cotizacion where Id_Cliente=? and Id_Usuario=?";

        $ejecutar = $conexion->db->prepare($sql);
        $ejecutar->bind_param('ii',$id_cliente,$id_usuario);
        $ejecutar->execute();
    
        $resultado = $ejecutar->get_result();

        while($fila = $resultado->fetch_array(MYSQLI_NUM)){
            if(strcmp($fila[1],$id_cliente)===0 && strcmp($fila[2],$id_usuario)===0){
                $estado=1;
                break;
            }
        }

        $conexion->desconectar();

        return $estado;
    }

    public function ValidarCotizacion2($id_cotizacion){   

        $conexion = new conexion();
        $conexion->conectar();
        $estado = 0;

        $sql = "select Id_Cotizacion from cotizacion where Id_cotizacion=?";

        $ejecutar = $conexion->db->prepare($sql);
        $ejecutar->bind_param('i',$id_cotizacion);
        $ejecutar->execute();
    
        $resultado = $ejecutar->get_result();

        while($fila = $resultado->fetch_array(MYSQLI_NUM)){
            if(strcmp($fila[1],$id_cotizacion)===0){
                $estado=1;
                break;
            }
        }

        $conexion->desconectar();

        return $estado;
    }


}

?>
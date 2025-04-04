<?php

include("../clases/Persona.php");

class Venta{

    public $estado;
    public $fecha;
    public $id_cliente;
    public $id_usuario;
    public $id_venta;
    public $descuento;
    public $pago_instalacion;
    public $n_comprobante;
    public $pago;
    public $serie;
    public $tipoc;
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

    public function getIdventa(){
        return $this->id_venta;
    }

    public function setIdventa($_idventa){
        $this->id_venta = $_idventa;
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

    public function getComprobante(){
        return $this->n_comprobante;
    }

    public function setComprobante($_ncomprobante){
        $this->n_comprobante = $_ncomprobante;
    }

    public function getPago(){
        return $this->pago;
    }

    public function setPago($_pago1){
        $this->pago = $_pago1;
    }

    public function getSerie(){
        return $this->serie;
    }

    public function setSerie($_serie1){
        $this->serie = $_serie1;
    }

    public function getTipoc(){
        return $this->tipoc;
    }

    public function setTipoc($_tipoc1){
        $this->tipoc = $_tipoc1;
    }

    public function getTotal(){
        return $this->total;
    }

    public function setTotal($_total1){
        $this->total = $_total1;
    }

    public function NuevaVenta($id_cliente,$id_usuario,$tipoc,$n_comprobante,$serie,$descuento,$pago_instalacion,$total,$pago){

        $conexion = new conexion();
        $conexion->conectar();
        $estado = 1;
        $sql = "insert into venta(Id_Cliente,Id_Usuario,Tipo_Comprobante,Num_Comprobante,Serie_Comprobante,Descuento,Pago_Envio_Instalacion,Total,Pagado,Estado) values(?,?,?,?,?,?,?,?,?,?)";
 
        $ejecutar = $conexion->db->prepare($sql);
        
        $ejecutar->bind_param('iisisdddii',$id_cliente,$id_usuario,$tipoc,$n_comprobante,$serie,$descuento,$pago_instalacion,$total,$pago,$estado);

        $ejecutar->execute();
        
        $conexion->desconectar();
    }
    //------------------------------------------------------------------------------------------------------------------
    //Funcion Guardar Informacion Empleado 

    public function GuardarVenta($id_cliente,$id_usuario,$tipoc,$n_comprobante,$serie,$fecha,$descuento,$pago_instalacion,$total,$pago){

        $conexion = new conexion();

        $conexion->conectar();
        $estado = 1;
        $sql = "insert into venta(Id_Cliente,Id_Usuario,Tipo_Comprobante,Num_Comprobante,Serie_Comprobante,Fecha,Descuento,Pago_Envio_Instalacion,Total,Pagado,Estado) values(?,?,?,?,?,?,?,?,?,?,?)";
 
        $ejecutar = $conexion->db->prepare($sql);
        
        $ejecutar->bind_param('iiisisdddii',$id_cliente,$id_usuario,$tipoc,$n_comprobante,$serie,$fecha,$descuento,$pago_instalacion,$total,$pago,$estado);

        $ejecutar->execute();
        
        $conexion->desconectar();
    }

        //------------------------------------------------------------------------------------------------------------------
    //Funcion Guardar Informacion Empleado 

    public function GuardarVenta2($id_cliente,$id_usuario,$tipoc){

        $conexion = new conexion();

        $conexion->conectar();
        $estado = 1;
        $sql = "insert into venta(Id_Cliente,Id_Usuario,Tipo_Comprobante,Estado) values(?,?,?,?)";
 
        $ejecutar = $conexion->db->prepare($sql);
        
        $ejecutar->bind_param('iisi',$id_cliente,$id_usuario,$tipoc,$estado);

        $ejecutar->execute();
        
        $conexion->desconectar();
    }

    //--------------------------------------------------------------------------------------------------------------------
    //Funcion mostrar los empleados registrados

    public function ObtenerVenta(){

     $conexion = new conexion();

     $conexion->conectar();

     $ventaob = array();

     $sql = "SELECT * FROM venta";

     $ejecutar = mysqli_query($conexion->db,$sql);

     while($fila = mysqli_fetch_array($ejecutar)){

        $ventaIndex = new Venta();

            $ventaIndex->setIdventa($fila[0]);
            $ventaIndex->setIdcliente($fila[1]);
            $ventaIndex->setIdusuario($fila[2]);
            $ventaIndex->setTipoc($fila[3]);
            $ventaIndex->setComprobante($fila[4]);
            $ventaIndex->setSerie($fila[5]);
            $ventaIndex->setFecha($fila[6]);
            $ventaIndex->setDescuento($fila[7]);
            $ventaIndex->setPagoinstalacion($fila[8]);
            $ventaIndex->setTotal($fila[9]);
            $ventaIndex->setPago($fila[10]);
            $ventaIndex->setEstado($fila[11]);
            
         array_push($ventaob,$ventaIndex);

    }

    $conexion->desconectar();
    
    return $ventaob;


    }

    //-----------------------------------------------------------------------------------------------------------------------------------
    //Funcion Editar empleados

    public function EditarVenta($n_comprobante,$serie,$descuento,$pago_instalacion,$total,$pago,$id_venta){ 


        $conexion = new conexion();

        $conexion->conectar();

        $sql = "update venta set Num_Comprobante=?, Serie_Comprobante=?, Descuento=?, Pago_Envio_Instalacion=?, Total=?, Pagado=? where id_venta=?";

        $ejecutar = $conexion->db->prepare($sql);

        $ejecutar->bind_param('isdddii',$n_comprobante,$serie,$descuento,$pago_instalacion,$total,$pago,$id_venta);

        $ejecutar->execute();

        $conexion->desconectar();

    }


    //------------------------------------------------------------------------------------------------------------------
    //Funcion para buscar los empleados

    public function BuscarVenta($id_venta){

        $conexion = new conexion();

        $conexion->conectar();

        $ventaArray = new Venta();
        
        $sql = "select * from venta where id_venta=?";

        $ejecutar = $conexion->db->prepare($sql);

        $ejecutar->bind_param('i',$id_venta);

        $ejecutar->execute();

        $resultado = $ejecutar->get_result();

        while($fila = $resultado->fetch_array(MYSQLI_NUM)){

            $ventaArray->setIdventa($fila[0]);
            $ventaArray->setIdcliente($fila[1]);
            $ventaArray->setIdusuario($fila[2]);
            $ventaArray->setTipoc($fila[3]);
            $ventaArray->setComprobante($fila[4]);
            $ventaArray->setSerie($fila[5]);
            $ventaArray->setFecha($fila[6]);
            $ventaArray->setTotal($fila[8]);
            $ventaArray->setPago($fila[9]);
            $ventaArray->setEstado($fila[10]);

        }

        $conexion->desconectar();

        return $ventaArray;

    }

    //-----------------------------------------------------------------------------------------------------------------------------------
    //Funcion eliminar empleado o desactivarlo

    public function EliminarVenta($id_venta){

        $conexion = new conexion();

        $conexion->conectar();

        $estado = 0;

        $sql = "update venta set estado=? where id_venta=?";

        $ejecutar = $conexion->db->prepare($sql);

        $ejecutar->bind_param('ii',$estado,$id_venta);

        $ejecutar->execute();

        $conexion->desconectar();


    }

    //-----------------------------------------------------------------------------------------------------------------------------------------
    //Funcion reactivar a empleado

    public function  ReactivarVenta($id_venta){

        $conexion = new conexion();

        $conexion->conectar();

        $estado = 1;

        $sql = "update venta set estado=? where id_venta=?";

        $ejecutar = $conexion->db->prepare($sql);

        $ejecutar->bind_param('ii',$estado,$id_venta);

        $ejecutar->execute();

        $conexion->desconectar();


    }

    public function ValidarVenta($id_cliente,$id_usuario){   


        $conexion = new conexion();

        $conexion->conectar();

        $estado = 0;

        $sql = "select Id_Cliente,Id_Usuario from venta where Id_Cliente=? and Id_Usuario=?";

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

    public function ValidarVenta2($id_venta){   

        $conexion = new conexion();
        $conexion->conectar();
        $estado = 0;

        $sql = "select Id_Venta from venta where Id_Venta=?";

        $ejecutar = $conexion->db->prepare($sql);
        $ejecutar->bind_param('i',$id_venta);
        $ejecutar->execute();
    
        $resultado = $ejecutar->get_result();

        while($fila = $resultado->fetch_array(MYSQLI_NUM)){
            if(strcmp($fila[1],$id_venta)===0){
                $estado=1;
                break;
            }
        }

        $conexion->desconectar();

        return $estado;
    }



}

?>
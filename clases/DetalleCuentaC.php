<?php

include("../clases/CuentaC.php");

class DetalleCuentaC{

    Public $id_detallecuentac;
    public $id_cuentaporcobrar;
    public $idusuario;
    public $fecha_pago;
    public $cantidad_abonar;
    public $saldo_pendiente;
    public $estado;
    
    //--------------------------- creacion del metod get y set -----------------------------------

    public function getIdDetallecuentac(){
        return $this->id_detallecuentac;
    }

    public function setIdDetallecuentac($_iddetallecuentac1){
        $this->id_detallecuentac = $_iddetallecuentac1;
    }

    public function getIdCuentaporcobrarc(){
        return $this->id_cuentaporcobrar;
    }

    public function setIdCuentaporcobrarc($_idcuentaporcobrar1){
        $this->id_cuentaporcobrar = $_idcuentaporcobrar1;
    }
    public function getFechapago(){
        return $this->fecha_pago;
    }

    public function setFechapago($_fechapago1){
        $this->fecha_pago = $_fechapago1;
    }
    public function getCantidadabonar(){
        return $this->cantidad_abonar;
    }

    public function setCantidadabonar($_cantidadabonar1){
        $this->cantidad_abonar = $_cantidadabonar1;
    }
    public function getSaldop(){
        return $this->saldo_pendiente;
    }

    public function setSaladop($_saldo_pendiente1){
        $this->saldo_pendiente = $_saldo_pendiente1;
    }

    public function getEstado(){
        return $this->estado;
    }

    public function setEstado($_estado1){
        $this->estado = $_estado1;
    }
    public function getIdusuarioc(){

        return $this->idusuario;
    }

    public function setIdusuarioc($_idusuario1){
        $this->idusuario = $_idusuario1;
    
    }
//------------------------------------------------------------------------------------------------------------------
//Funcion Guardar Informacion del detalle del pago

public function GuardarDetalleCuentaC($id_cuentaporcobrar,$idusuario,$cantidad_abonar,$saldo_pendiente){

    $conexion = new conexion();

    $conexion->conectar();
    $estado=1;
    $sql = "insert into detalle_pagos(Id_Cuentaporcobrar,Id_usuario,cantidad_abonar,Saldo_pendiente,Estado) values(?,?,?,?,?)";

    $ejecutar = $conexion->db->prepare($sql);
    
    $ejecutar->bind_param('iiddi',$id_cuentaporcobrar,$idusuario,$cantidad_abonar,$saldo_pendiente,$estado);

    $ejecutar->execute();
    
    $conexion->desconectar();
}

//-----obtener detalle de cuenta
public function ObtenerDetalleCuentaC(){

    $conexion = new conexion();
    $conexion->conectar();
    $detallepagosob = array();

    $sql = "SELECT * FROM detalle_pagos";
    $ejecutar = mysqli_query($conexion->db,$sql);

    while($fila = mysqli_fetch_array($ejecutar)){

       $detallepIndex = new DetalleCuentaC();

       $detallepIndex->setIdDetallecuentac($fila[0]);
       $detallepIndex->setIdCuentaporcobrarc($fila[1]);
       $detallepIndex->setIdusuarioc($fila[2]);
       $detallepIndex->setFechapago($fila[3]);
       $detallepIndex->setCantidadabonar($fila[4]);
       $detallepIndex->setSaladop($fila[5]);
       $detallepIndex->setEstado($fila[6]);

        array_push($detallepagosob,$detallepIndex);

   }

   $conexion->desconectar();
   
   return $detallepagosob;

}
//------------------------------------------------------------------------------------------------------------------
    //Funcion para buscar detalle de cuenta

    public function BuscarDetallecuentac($id_detallecuentac){

        $conexion = new conexion();

        $conexion->conectar();

        $detallecuentacArray = new DetalleCuentaC();
        
        $sql = "select * from Detalle_pagos where id_detallepagos=?";

        $ejecutar = $conexion->db->prepare($sql);

        $ejecutar->bind_param('i',$id_detallecuentac);

        $ejecutar->execute();

        $resultado = $ejecutar->get_result();

        while($fila = $resultado->fetch_array(MYSQLI_NUM)){
        
            $detallecuentacArray->setIdDetallecuentac($fila[0]);
            $detallecuentacArray->setIdCuentaporcobrarc($fila[1]);
            $detallecuentacArray->setIdusuarioc($fila[2]);
            $detallecuentacArray->setFechapago($fila[3]);
            $detallecuentacArray->setCantidadabonar($fila[4]);
            $detallecuentacArray->setSaladop($fila[5]);
            $detallecuentacArray->setEstado($fila[6]);
        }

        $conexion->desconectar();

        return $detallecuentacArray;

    }

//-------validad si el pago

    public function Validarpago($id_cuentaporcobrar){   


        $conexion = new conexion();

        $conexion->conectar();

        $estado = 0;

        $sql = "select id_cuentaporcobrar from detalle_pagos where id_cuentaporcobrar=?";

        $ejecutar = $conexion->db->prepare($sql);
        $ejecutar->bind_param('i', $id_cuentaporcobrar);
        $ejecutar->execute();
    
        $resultado = $ejecutar->get_result();

        while($fila = $resultado->fetch_array(MYSQLI_NUM)){
            if(strcmp($fila[1],$id_cuentaporcobrar)===0){
                $estado=1;
                break;
            }
        }

        $conexion->desconectar();

        return $estado;
    }
    public function ObtenerUltimoIdPagoCredito(){
        $conexion = new conexion();
        $conexion->conectar();
    
        $sql = "SELECT MAX(id_Detallepagos) FROM detalle_pagos";
        $result = mysqli_query($conexion->db, $sql);
    
        if ($result) {
            $row = mysqli_fetch_array($result);
            $ultimoId = $row[0];
        } else {
            $ultimoId = null;
        }
    
        $conexion->desconectar();
        
        return $ultimoId;
    }

}

?>
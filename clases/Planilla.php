<?php

include("../db/conexion.php");

class Planilla{ 

    public $id_planilla;
    public $id_empleado;
    public $tipo;
    public $cantidad;
    public $estado;
    public $mes;
    public $anio;
    public $nombre2;
    public $apellido;
    public $salario;


    public function getIdplanilla(){ 
     
        return $this->id_planilla;

    }

    public function setIdplanilla($id_planilla1){ 

        $this->id_planilla = $id_planilla1;

    }


    public function getIdempleado(){  

        return $this->id_empleado;

    }

    public function setIdempleado($id_emppleado1){

        $this->id_empleado = $id_emppleado1;

    }

    public function getTipo(){ 

        return $this->tipo;
    }

    public function setTipo($tipo_1){

        $this->tipo = $tipo_1;

    }

    public function getEstado(){

        return $this->estado;

    }

    public function setEstado($estado_1){    

        $this->estado = $estado_1;

    }

    public function getMes(){ 

        return $this->mes;

    }

    public function setMes($mes1){


        $this->mes = $mes1;


    }

    public function getAnio(){ 

        return $this->anio;

    }

    public function setAnio($anio1){ 

        $this->anio = $anio1;


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

    public function getSalario(){ 

        return $this->salario;

    }

    public function setSalario($salario1){ 

        $this->salario = $salario1;


    }

    public function getCantidad(){ 

        return $this->cantidad;

    }

    public function setCantidad($cantidad1){ 

        $this->cantidad = $cantidad1;


    }


    //-------------------------------------------------------------------------------------------------------------------------------------
    //funcion ingresar pago planilla

    public function PagoPlanilla($idempleado,$tipo,$cantidad,$mes,$anio){

        $conexion = new conexion();

        $conexion->conectar();

        $sql = "insert into planilla(id_empleado,tipo,cantidad,mes,anio) values(?,?,?,?,?)";

        $ejecutar = $conexion->db->prepare($sql);

        $ejecutar->bind_param('issss',$idempleado,$tipo,$cantidad,$mes,$anio);

        $ejecutar->execute();

        $conexion->desconectar();

    }

    //--------------------------------------------------------------------------------------------------------
    //funcion mostrar pago de planillas

    public function ObtenerPlanillaPago(){
        
        $conexion = new conexion();

        $conexion->conectar();

        $resultadoArray = array();
        
        $sql = "SELECT planilla.id_planilla,empleado.Nombre, empleado.Apellido, empleado.Salario, planilla.tipo, planilla.cantidad,planilla.mes, planilla.anio,planilla.estado FROM empleado INNER JOIN planilla ON empleado.id_empleado = planilla.id_empleado where planilla.estado=1";

        $ejecutar = mysqli_query($conexion->db,$sql);

        while($fila = mysqli_fetch_array($ejecutar)){

            $plaIndex = new Planilla();

             $plaIndex->setIdplanilla($fila[0]);
             $plaIndex->setNombre($fila[1]);
             $plaIndex->setApellido($fila[2]);
             $plaIndex->setSalario($fila[3]);
             $plaIndex->setTipo($fila[4]);
             $plaIndex->setCantidad($fila[5]);
             $plaIndex->setMes($fila[6]);
             $plaIndex->setAnio($fila[7]);
             $plaIndex->setEstado($fila[8]);

             array_push($resultadoArray,$plaIndex);

        }

        $conexion->desconectar();
        
        return $resultadoArray;
    }

    //-----------------------------------------------------------------------------------------------------
    //funcion buscar pago

    public function BuscarPago($idpago){


        $conexion = new conexion();

        $conexion->conectar();

        $plaArray = new Planilla();
        
        $sql = "SELECT planilla.id_planilla,empleado.Nombre, empleado.Apellido, empleado.Salario, planilla.tipo, planilla.cantidad,planilla.mes, planilla.anio,planilla.estado FROM empleado INNER JOIN planilla ON empleado.id_empleado = planilla.id_empleado where planilla.id_planilla=?";

        $ejecutar = $conexion->db->prepare($sql);
        $ejecutar->bind_param('i', $idpago);
        $ejecutar->execute();
    
        $resultado = $ejecutar->get_result();

        while($fila = $resultado->fetch_array(MYSQLI_NUM)){

            $plaArray ->setIdplanilla($fila[0]);
            $plaArray ->setNombre($fila[1]);
            $plaArray ->setApellido($fila[2]);
            $plaArray ->setSalario($fila[3]);
            $plaArray ->setTipo($fila[4]);
            $plaArray ->setCantidad($fila[5]);
            $plaArray ->setMes($fila[6]);
            $plaArray ->setAnio($fila[7]);
            $plaArray ->setEstado($fila[8]);


        }

        $conexion->desconectar();

        return  $plaArray;


    }

    //-------------------------------------------------------------------------------------------------------------------------------
    //Funcion cancelar pago

    public function CancelarPago($idpago){

        $conexion = new conexion();

        $conexion->conectar();

        $estado=0;

        $sql = "update planilla set estado=? where id_planilla=?";

        $ejecutar = $conexion->db->prepare($sql);

        $ejecutar->bind_param('ii',$estado,$idpago);

        $ejecutar->execute();

        $conexion->desconectar();
        

    }

    //-----------------------------------------------------------------------------------------------------------------------------
    //Validar pagos de planilla empleado

    public function ValidarPago($id,$mes,$anio){   


        $conexion = new conexion();

        $conexion->conectar();

        $estado = 0;
        $estado1 = 1;
        $sql = "select id_empleado, mes, anio,estado from planilla where id_empleado=? and mes=? and anio=? and estado=?";

        $ejecutar = $conexion->db->prepare($sql);
        $ejecutar->bind_param('issi', $id,$mes,$anio,$estado1);
        $ejecutar->execute();
    
        $resultado = $ejecutar->get_result();

        while($fila = $resultado->fetch_array(MYSQLI_NUM)){
            if(strcmp($fila[0],$id)===0 && strcmp($fila[1],$mes)===0 && strcmp($fila[2],$anio)===0 && strcmp($fila[3],$estado1)===0){
                $estado=1;
                break;
            }
        }

        $conexion->desconectar();

        return $estado;
    }

}

?>
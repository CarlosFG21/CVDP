<?php

include("../db/conexion.php");

class Empleado{
//variables publicas
    public $id_empleado;
    public $id_usuario;
    public $nombre;
    public $apellido;
    public $edad;
    public $puesto;
    public $salario;
    public $fecha_ent;
    public $estado;

 //metodos get y set
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
        return $this->id_usuario;
    }
    public function setIdusuario($_idusuario){
        $this->id_usuario = $_idusuario;
    }


    public function getNombre(){
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




    //------------------------------------------------------------------------------------------------------------------
    //Funcion Guardar Informacion Empleado

    public function GuardarEmpleado($id_usuario,$nombre,$apellido,$edad,$puesto,$salario,$fecha_ent){

        $conexion = new conexion();

        $conexion->conectar();
        $estado=1;
        $sql = "insert into empleado(Id_Usuario,Nombre,Apellido,Edad,Puesto,Salario,Fecha_Entrada,Estado) values(?,?,?,?,?,?,?,?)";
 
        $ejecutar = $conexion->db->prepare($sql);
        
        $ejecutar->bind_param('issisdsi',$id_usuario,$nombre,$apellido,$edad,$puesto,$salario,$fecha_ent,$estado);

        $ejecutar->execute();
        
        $conexion->desconectar();
    }

    //--------------------------------------------------------------------------------------------------------------------
    //Funcion mostrar los empleados registrados

    public function ObtenerEmpleados(){

     $conexion = new conexion();

     $conexion->conectar();

     $empleadoob = array();

     $sql = "SELECT * FROM empleado";

     $ejecutar = mysqli_query($conexion->db,$sql);

     while($fila = mysqli_fetch_array($ejecutar)){

        $empleadoIndex = new Empleado();

         $empleadoIndex->setIdempleado($fila[0]);
         $empleadoIndex->setNombre($fila[2]);
         $empleadoIndex->setApellido($fila[3]);
         $empleadoIndex->setEdad($fila[4]);
         $empleadoIndex->setPuesto($fila[5]);
         $empleadoIndex->setSalario($fila[6]);
         $empleadoIndex->setFecha($fila[7]);
         $empleadoIndex->setEstado($fila[8]);

         array_push($empleadoob,$empleadoIndex);

    }

    $conexion->desconectar();
    
    return $empleadoob;


    }

    //-----------------------------------------------------------------------------------------------------------------------------------
    //Funcion Editar empleados

    public function EditarEmpleado($nombre,$apellido,$edad,$puesto,$salario,$fecha_ent,$id_empleado){ 


        $conexion = new conexion();

        $conexion->conectar();

        $sql = "update empleado set nombre=?, apellido=?, edad=?, puesto=?, salario=?, fecha_entrada=? where id_empleado=?";

        $ejecutar = $conexion->db->prepare($sql);

        $ejecutar->bind_param('ssisdsi',$nombre,$apellido,$edad,$puesto,$salario,$fecha_ent,$id_empleado);

        $ejecutar->execute();

        $conexion->desconectar();

    }


    //------------------------------------------------------------------------------------------------------------------
    //Funcion para buscar los empleados

    public function BuscarEmpleado($id_empleado){

        $conexion = new conexion();

        $conexion->conectar();

        $empleadoArray = new Empleado();
        
        $sql = "select * from empleado where id_empleado=?";

        $ejecutar = $conexion->db->prepare($sql);

        $ejecutar->bind_param('i',$id_empleado);

        $ejecutar->execute();

        $resultado = $ejecutar->get_result();

        while($fila = $resultado->fetch_array(MYSQLI_NUM)){


            $empleadoArray->setIdempleado($fila[0]);
            $empleadoArray->setIdusuario($fila[1]);
            $empleadoArray->setNombre($fila[2]);
            $empleadoArray->setApellido($fila[3]);
            $empleadoArray->setEdad($fila[4]);
            $empleadoArray->setPuesto($fila[5]);
            $empleadoArray->setSalario($fila[6]);
            $empleadoArray->setFecha($fila[7]);
            $empleadoArray->setEstado($fila[8]);
        

        }

        $conexion->desconectar();

        return $empleadoArray;

    }

    //-----------------------------------------------------------------------------------------------------------------------------------
    //Funcion eliminar empleado o desactivarlo

    public function EliminarEmpleado($id_empleado){


        $conexion = new conexion();

        $conexion->conectar();

        $estado = 0;

        $sql = "update empleado set estado=? where id_empleado=?";

        $ejecutar = $conexion->db->prepare($sql);

        $ejecutar->bind_param('ii',$estado,$id_empleado);

        $ejecutar->execute();

        $conexion->desconectar();


    }

    //-----------------------------------------------------------------------------------------------------------------------------------------
    //Funcion reactivar a empleado

    public function  ReactivarEmpleado($id_empleado){


        $conexion = new conexion();

        $conexion->conectar();

        $estado = 1;

        $sql = "update empleado set estado=? where id_empleado=?";

        $ejecutar = $conexion->db->prepare($sql);

        $ejecutar->bind_param('ii',$estado,$id_empleado);

        $ejecutar->execute();

        $conexion->desconectar();


    }

    public function ValidarEmpleado($nombre,$apellido){   


        $conexion = new conexion();

        $conexion->conectar();

        $estado = 0;

        $sql = "select nombre,apellido from empleado where nombre=? and apellido=?";

        $ejecutar = $conexion->db->prepare($sql);
        $ejecutar->bind_param('ss', $nombre,$apellido);
        $ejecutar->execute();
    
        $resultado = $ejecutar->get_result();

        while($fila = $resultado->fetch_array(MYSQLI_NUM)){
            if(strcmp($fila[0],$nombre)===0 && strcmp($fila[1],$apellido)===0){
                $estado=1;
                break;
            }
        }

        $conexion->desconectar();

        return $estado;
    }



}

?>
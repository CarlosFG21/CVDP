<?php

include("../clases/DetalleV.php");

class CuentaC{

    public $id_cobrar;
    public $id_cliente;
    public $id_venta;
    public $deuda_total;
    public $estado;
    public $fecha;

    //--------------------------- creacion del metod get y set -----------------------------------

    public function getEstado(){
        return $this->estado;
    }

    public function setEstado($_estado1){
        $this->estado = $_estado1;
    }

    public function getIdcliente(){
        return $this->id_cliente;
    }

    public function setIdcliente($_idcliente1){
        $this->id_cliente = $_idcliente1;
    }

    public function getIdcobrar(){
        return $this->id_cobrar;
    }

    public function setIdcobrar($_idcobrar1){
        $this->id_cobrar = $_idcobrar1;
    }

    public function getIdventa(){
        return $this->id_venta;
    }

    public function setIdventa($_idventa1){
        $this->id_venta = $_idventa1;
    }
    public function getDeuda(){
        return $this->deuda_total;
    }

    public function setDeuda($_deuda_total1){
        $this->deuda_total = $_deuda_total1;
    }
    public function getFecha(){
        return $this->fecha;
    }
    public function setFecha($_fecha1){
        $this->fecha = $_fecha1;
    }
//------------------------------------------------------------------------------------------------------------------
//Funcion Guardar Informacion de la cuentas por cobrar

public function GuardarCuentaC1($id_cliente,$deuda_total){

    $conexion = new conexion();
    $conexion->conectar();

    $sql2 = "SELECT MAX(id_venta) FROM venta";
    $result = mysqli_query($conexion->db, $sql2);
    if ($result) {
        $row = mysqli_fetch_array($result);
        $ultimoId = $row[0];
    } else {
        $ultimoId = null;
    }
    $id_venta = $ultimoId;
    $estado=1;
    $sql = "insert into Cuentaspor_cobrar(Id_Cliente,Id_venta,Deuda_Total,Estado) values(?,?,?,?)";

    $ejecutar3 = $conexion->db->prepare($sql);
    
    $ejecutar3->bind_param('iidi',$id_cliente,$id_venta,$deuda_total,$estado);

    $ejecutar3->execute();
    
    $conexion->desconectar();
}

public function GuardarCuentaC($id_cliente, $id_venta, $deuda_total) {
    $conexion = new conexion();
    $conexion->conectar();
    $estado = 1;

    // Verificar si $ventas es un array
    if (is_array($id_venta)) {
        // Convertir el array de IDs de ventas en una cadena separada por comas
        $ventas_ids = implode(',', $id_venta);
    } else {
        // Si no es un array, simplemente asignar el valor a $ventas_ids
        $ventas_ids = $id_venta;
    }

    $sql = "INSERT INTO Cuentaspor_cobrar (Id_Cliente, Id_Venta, Deuda_Total, Estado) VALUES (?, ?, ?, ?)";
    $ejecutar = $conexion->db->prepare($sql);
    
    // Enlazar parámetros y ejecutar la consulta
    $ejecutar->bind_param('isdi', $id_cliente, $ventas_ids, $deuda_total, $estado);
    $ejecutar->execute();
    
    $conexion->desconectar();
}
//-----------------------------------------------------------------------------------------------------------------------------------
    //Funcion Editar datos de la cuenta

    public function EditarCuentac($id_cobrar,$id_venta,$deuda_total){ 

        $conexion = new conexion();
        $conexion->conectar();
        
        if($deuda_total == 0){
            //modificar el estado del cuenta por cobrar de pendiente a cancelada/pagado
            $estado = 0;
            $sql2 = "update cuentaspor_cobrar set Deuda_Total=?, Estado=? where Id_cobrar=?";
            $ejecutar2 = $conexion->db->prepare($sql2);
            $ejecutar2->bind_param('dii', $deuda_total, $estado, $id_cobrar);
            $ejecutar2->execute();
            //cambiar el metodo de pago a la venta de credito a pagado
            $pagado = 1;
            $sql3 = "update venta set Pagado=? where Id_venta=?";
            $ejecutar3 = $conexion->db->prepare($sql3);
            $ejecutar3->bind_param('ii', $pagado, $id_venta);
            $ejecutar3->execute();


        }else{
            $sql = "update cuentaspor_cobrar set Deuda_Total=? where Id_cobrar=?";
            $ejecutar = $conexion->db->prepare($sql);
            $ejecutar->bind_param('di',$deuda_total,$id_cobrar);
            $ejecutar->execute();
        }
        
        $conexion->desconectar();

    }
    
    

public function ObtenerCuentaC(){

    $conexion = new conexion();
    $conexion->conectar();
    $cuentacob = array();

    $sql = "SELECT * FROM cuentaspor_cobrar";

    $ejecutar = mysqli_query($conexion->db,$sql);

    while($fila = mysqli_fetch_array($ejecutar)){

       $cuentacIndex = new CuentaC();

       $cuentacIndex->setIdcobrar($fila[0]);
       $cuentacIndex->setIdcliente($fila[1]);
       $cuentacIndex->setIdventa($fila[2]);
       $cuentacIndex->setDeuda($fila[3]);
       $cuentacIndex->setEstado($fila[4]);
       $cuentacIndex->setFecha($fila[5]);

        array_push($cuentacob,$cuentacIndex);

   }

   $conexion->desconectar();
   
   return $cuentacob;

}

public function ValidarCuentaC($id_cobrar){   

    $conexion = new conexion();
    $conexion->conectar();
    $estado = 0;

    $sql = "select Id_cobrar from cuentaspor_cobrar where Id_cobrar=?";

    $ejecutar = $conexion->db->prepare($sql);
    $ejecutar->bind_param('i',$id_cobrar);
    $ejecutar->execute();

    $resultado = $ejecutar->get_result();

    while($fila = $resultado->fetch_array(MYSQLI_NUM)){
        if(strcmp($fila[0],$id_cobrar)===0){
            $estado=1;
            break;
        }
    }

    $conexion->desconectar();

    return $estado;
}



//------------------------------------------------------------------------------------------------------------------
    //Funcion para buscar los empleados

    public function obtenerCuentasPorCobrar($id_cobrar){

        $conexion = new conexion();

        $conexion->conectar();

        $CuentaArray = new CuentaC();
        
        $sql = "select * from cuentaspor_cobrar where id_cobrar=?";

        $ejecutar = $conexion->db->prepare($sql);

        $ejecutar->bind_param('i',$id_cobrar);

        $ejecutar->execute();

        $resultado = $ejecutar->get_result();

        while($fila = $resultado->fetch_array(MYSQLI_NUM)){

            $CuentaArray->setIdcobrar($fila[0]);
            $CuentaArray->setIdcliente($fila[1]);
            $CuentaArray->setIdventa($fila[2]);
            $CuentaArray->setDeuda($fila[3]);
            $CuentaArray->setEstado($fila[4]);
            $CuentaArray->setFecha($fila[5]);

        }

        $conexion->desconectar();

        return $CuentaArray;

    }

      //------------------------------------------------------------------------------------------------------------------
    //Funcion para buscar los empleados

    public function BuscarCuentac($id_cobrar){

        $conexion = new conexion();

        $conexion->conectar();

        $CuentaArray = new CuentaC();
        
        $sql = "select * from cuentaspor_cobrar where id_cobrar=?";

        $ejecutar = $conexion->db->prepare($sql);

        $ejecutar->bind_param('i',$id_cobrar);

        $ejecutar->execute();

        $resultado = $ejecutar->get_result();

        while($fila = $resultado->fetch_array(MYSQLI_NUM)){

            $CuentaArray->setIdcobrar($fila[0]);
            $CuentaArray->setIdcliente($fila[1]);
            $CuentaArray->setIdventa($fila[2]);
            $CuentaArray->setDeuda($fila[3]);
            $CuentaArray->setEstado($fila[4]);
            $CuentaArray->setFecha($fila[5]);

        }

        $conexion->desconectar();

        return $CuentaArray;

    }
    public function BuscarCuentacV($id_venta){

        $conexion = new conexion();

        $conexion->conectar();

        $CuentaArray = new CuentaC();
        
        $sql = "select * from cuentaspor_cobrar where id_venta=?";

        $ejecutar = $conexion->db->prepare($sql);

        $ejecutar->bind_param('i',$id_venta);

        $ejecutar->execute();

        $resultado = $ejecutar->get_result();

        while($fila = $resultado->fetch_array(MYSQLI_NUM)){

            $CuentaArray->setIdcobrar($fila[0]);
            $CuentaArray->setIdcliente($fila[1]);
            $CuentaArray->setIdventa($fila[2]);
            $CuentaArray->setDeuda($fila[3]);
            $CuentaArray->setEstado($fila[4]);
            $CuentaArray->setFecha($fila[5]);

        }

        $conexion->desconectar();

        return $CuentaArray;

    }
    public function ObtenerUltimoIdPagoCredito(){
        $conexion = new conexion();
        $conexion->conectar();
    
        $sql = "SELECT MAX(id_cobrar) FROM cuentaspor_cobrar";
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

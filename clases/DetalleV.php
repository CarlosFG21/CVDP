<?php

include("../Clases/Venta.php");

class DetalleV{

public $cantidad;
public $cantidad_medida;
public $descuento;
public $estado;
public $id_detallev;
public $id_producto;
public $id_venta;
public $unidad_medida;
public $precio;

public function getCantidad(){
    return $this->cantidad;
}
public function setCantidad($_cantidad1){
    $this->cantidad = $_cantidad1;
}


public function getCantidadm(){
    return $this->cantidad_medida;
}
public function setCantidadm($_cantidadm){
    $this->cantidad_medida = $_cantidadm;
}


public function getDescuento(){
    $this->descuento;
}
public function setDescuento($_descuento1){
    $this->descuento = $_descuento1;
}


public function getEstado(){
    return $this->estado;
}
public function setEstado($_estado1){
    $this->estado = $_estado1;
}


public function getIdetallev(){
    return $this->id_detallev;
}
public function setIdetallev($_idetallev){
    $this->id_detallev = $_idetallev;
}


public function getIdproducto(){
    return $this->id_producto;
}
public function setIdproducto($_idproducto){
    $this->id_producto = $_idproducto;
}


public function getIdventa(){
    return $this->id_venta;
}
public function setIdventa($_idventa){
    $this->id_venta = $_idventa;
}


public function getUnidadm(){
    return $this->unidad_medida;
}
public function setUnidadm($_unidadm){
    $this->unidad_medida = $_unidadm;
}

public function getPrecio(){
    return $this->unidad_medida;
}
public function setPrecio($_unidadm){
    $this->unidad_medida = $_unidadm;
}

//------------------------------------------------------------------------------------------------------------------
//Funcion Guardar Informacion detalle venta

public function GuardarDetalleV($id_venta,$id_producto,$cantidad_medida,$unidad_medida,$precio){

    $conexion = new conexion();

    $conexion->conectar();
    $estado=1;
    $sql = "insert into detalle_venta(Id_Venta,Id_Producto,Cantidad_Medida,Unidad_Medida,Precio,Estado) values(?,?,?,?,?,?)";

    $ejecutar = $conexion->db->prepare($sql);
    
    $ejecutar->bind_param('iidsdi',$id_venta,$id_producto,$cantidad_medida,$unidad_medida,$precio,$estado);

    $ejecutar->execute();
    
    $conexion->desconectar();
}

//--------------------------------------------------------------------------------------------------------------------
//Funcion mostrar los empleados registrados

    public function ObtenerDetalleV(){

        $conexion = new conexion();
        $conexion->conectar();
        $detallevob = array();
   
        $sql = "SELECT * FROM detalle_venta";
   
        $ejecutar = mysqli_query($conexion->db,$sql);
   
        while($fila = mysqli_fetch_array($ejecutar)){
   
           $detallevIndex = new DetalleV();
   
           $detallevIndex->setIdetallev($fila[0]);
           $detallevIndex->setIdventa($fila[1]);
           $detallevIndex->setIdproducto($fila[2]);
           $detallevIndex->setCantidadm($fila[3]);
           $detallevIndex->setUnidadm($fila[4]);
           $detallevIndex->setPrecio($fila[5]);
           $detallevIndex->setEstado($fila[6]);

            array_push($detallevob,$detallevIndex);
   
       }
   
       $conexion->desconectar();
       
       return $detallevob;

    }

     //-----------------------------------------------------------------------------------------------------------------------------------
    //Funcion Editar Persona

    public function EditarDetalleV($cantidad_medida,$unidad_medida,$precio,$id_detallev){ 

        $conexion = new conexion();
        $conexion->conectar();

        $sql = "update detalle_venta set Cantidad_Medida=?, Unidad_Medida=?, Precio=? where id_Detalleventa=?";

        $ejecutar = $conexion->db->prepare($sql);

        $ejecutar->bind_param('dsdi',$cantidad_medida,$unidad_medida,$precio,$id_detallev);

        $ejecutar->execute();

        $conexion->desconectar();

    }


    //------------------------------------------------------------------------------------------------------------------
    //Funcion para buscar las personas

    public function BuscarDetalleV($id_detallev){

        $conexion = new conexion();
        $conexion->conectar();

        $detallevArray = new DetalleV();
        
        $sql = "select * from detalle_venta where id_detalleventa=?";

        $ejecutar = $conexion->db->prepare($sql);

        $ejecutar->bind_param('i',$id_detallev);

        $ejecutar->execute();

        $resultado = $ejecutar->get_result();

        while($fila = $resultado->fetch_array(MYSQLI_NUM)){

            $detallevArray->setIdetallev($fila[0]);
            $detallevArray->setIdventa($fila[1]);
            $detallevArray->setIdproducto($fila[2]);
            $detallevArray->setCantidadm($fila[3]);
            $detallevArray->setUnidadm($fila[4]);
            $detallevArray->setPrecio($fila[5]);
            $detallevArray->setEstado($fila[6]);

        }

        $conexion->desconectar();

        return $detallevArray;
    }

    //-----------------------------------------------------------------------------------------------------------------------------------
    //Funcion eliminar persona

    public function EliminarDetalleV($id_detallev){

        $conexion = new conexion();
        $conexion->conectar();

        $estado = 0;
        $sql = "update detalle_venta set estado=? where id_detalleventa=?";

        $ejecutar = $conexion->db->prepare($sql);

        $ejecutar->bind_param('ii',$estado,$id_detallev);
        $ejecutar->execute();
        $conexion->desconectar();

    }
    public function ValidarDetalleV($id_venta,$id_producto){   


        $conexion = new conexion();
        $conexion->conectar();
        $estado = 0;

        $sql = "select id_venta,id_producto from detalle_venta where id_venta=? and id_producto=?";

        $ejecutar = $conexion->db->prepare($sql);
        $ejecutar->bind_param('ss', $id_venta,$id_producto);
        $ejecutar->execute();
    
        $resultado = $ejecutar->get_result();

        while($fila = $resultado->fetch_array(MYSQLI_NUM)){
            if(strcmp($fila[0],$id_venta)===0 && strcmp($fila[1],$id_producto)===0){
                $estado=1;
                break;
            }
        }

        $conexion->desconectar();
        return $estado;
    }
    public function ObtenerUltimoIdVenta(){
        $conexion = new conexion();
        $conexion->conectar();
    
        $sql = "SELECT MAX(id_venta) FROM venta";
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
    
    public function CalcularTotalVenta($id_venta){
        $conexion = new conexion();
        $conexion->conectar();
        $estado=1;
        $total = 0;
        $sql = "SELECT SUM(Precio) AS total FROM detalle_venta WHERE Id_Venta = ? AND Estado=?";
        
        $ejecutar = $conexion->db->prepare($sql);
        $ejecutar->bind_param('ii',$id_venta,$estado);
        $ejecutar->execute();
        
        $resultado = $ejecutar->get_result();
        
        if ($fila = $resultado->fetch_assoc()) {
            $total = $fila['total'];
        }
        
        $conexion->desconectar();
        
        return $total;
    }

}



class Producto1{

    public $cantidad_producto;
    public $descripcion_producto;
    public $estado_producto;
    public $id_categoria;
    public $id_detalle;
    public $id_producto;
    public $nombre_producto;
    public $precio_producto;
    public $ubicacion_producto;
    
    //------------------- creacion de metodos get y set
    
    public function getCantidad(){  return $this->cantidad_producto;
    }
    
    public function setCantidad($_cantidad_producto1){
        $this->cantidad_producto = $_cantidad_producto1;
    }
    
    public function getDescripcion(){
        return $this->descripcion_producto;
    }
    
    public function setDescripcion($_descripcion_producto1){
        $this->descripcion_producto = $_descripcion_producto1;
    }
    
    public function getEstado(){
        return $this->estado_producto;
    }
    
    public function setEstado($_estado_producto1){
        $this->estado_producto = $_estado_producto1;
    }
    
    public function getIdcategoria(){
        return $this->id_categoria;
    }
    public function setIdcategoria($_idcategoria){
        $this->id_categoria = $_idcategoria;
    }
    
    public function getIdetalle(){
        return $this->id_detalle;
    }
    
    public function setIdetalle($_idetalle){
        $this->id_detalle = $_idetalle;
    }
    
    public function getIdproducto(){
        return $this->id_producto;
    }
    
    public function setIdproducto($_idproducto){
        $this->id_producto = $_idproducto;
    }
    
    public function getNombre(){
        return $this->nombre_producto;
    }
    public function setNombre($_nombre_producto1){
        $this->nombre_producto = $_nombre_producto1;
    }
    public function getPrecio(){
        return $this->precio_producto;
    }
    
    public function setPrecio($_precio_producto1){
        $this->precio_producto = $_precio_producto1;
    }
    
    public function getUbicacion(){
        return $this->ubicacion_producto;
    }
    
    public function setUbicacion($_ubicacion_producto1){
        $this->ubicacion_producto = $_ubicacion_producto1;
    }
    
    //--------------------------------------------------------------------------------------------------------------------
        //Funcion mostrar los empleados registrados
    
        public function ObtenerProducto(){
    
            $conexion = new conexion();
       
            $conexion->conectar();
       
            $productoob = array();
       
            $sql = "SELECT * FROM producto";
       
            $ejecutar = mysqli_query($conexion->db,$sql);
       
            while($fila = mysqli_fetch_array($ejecutar)){
       
               $productoIndex = new Producto1();
       
                   $productoIndex->setIdproducto($fila[0]);
                   $productoIndex->setIdetalle($fila[1]);
                   $productoIndex->setIdcategoria($fila[2]);
                   $productoIndex->setNombre($fila[3]);
                   $productoIndex->setDescripcion($fila[4]);
                   $productoIndex->setCantidad($fila[5]);
                   $productoIndex->setPrecio($fila[6]);
                   $productoIndex->setUbicacion($fila[7]);
                   $productoIndex->setEstado($fila[8]);
                   
                array_push($productoob,$productoIndex);
       
           }
       
           $conexion->desconectar();
           
           return $productoob;
       
       
           }
           
       
    }
    
    
  
    
?>
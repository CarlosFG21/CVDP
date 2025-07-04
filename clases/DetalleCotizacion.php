<?php

include("../Clases/Cotizacion.php");

class DetalleCotizacion{

public $cantidad;
public $cantidad_medida;
public $descuento;
public $estado;
public $id_detallecotizacion;
public $id_producto;
public $id_cotizacion;
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


public function getIdetallecotizacion(){
    return $this->id_detallecotizacion;
}
public function setIdetallecotizacion($id_detallecotizacion){
    $this->id_detallecotizacion = $id_detallecotizacion;
}


public function getIdproducto(){
    return $this->id_producto;
}
public function setIdproducto($_idproducto){
    $this->id_producto = $_idproducto;
}


public function getIdcotizacion(){
    return $this->id_cotizacion;
}
public function setIdcotizacion($_idcotizacion){
    $this->id_cotizacion = $_idcotizacion;
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

public function GuardarDetalleCotizacion($id_cotizacion,$id_producto,$cantidad_medida,$unidad_medida,$precio){

    $conexion = new conexion();

    $conexion->conectar();
    $estado=1;
    $sql = "insert into detalle_cotizacion(Id_Cotizacion,Id_Producto,Cantidad_Medida,Unidad_Medida,Precio,Estado) values(?,?,?,?,?,?)";

    $ejecutar = $conexion->db->prepare($sql);
    
    $ejecutar->bind_param('iidsdi',$id_cotizacion,$id_producto,$cantidad_medida,$unidad_medida,$precio,$estado);

    $ejecutar->execute();
    
    $conexion->desconectar();
}
public function NuevoDetalleC($datosTabla,$id_cotizacion){

    $conexion = new conexion();
    $conexion->conectar();
    
    // Preparar y ejecutar las consultas para insertar los datos en la base de datos
    foreach ($datosTabla as $cotizacion) {
    $idcotizacion = $id_cotizacion;    
    $id_producto = $cotizacion['idproducto'];
    $cantidad_medida = $cotizacion['cantidad'];
    $unidad_medida = $cotizacion['unidadmedida'];
    $precio = $cotizacion['precio'];
    $subtotal = $precio * $cantidad_medida;
    $subtotal = round($subtotal, 2);
    $estado=1;
   
    $sql = "insert into detalle_cotizacion(Id_Cotizacion,Id_Producto,Cantidad_Medida,Unidad_Medida,Precio,Estado) values(?,?,?,?,?,?)";

    $ejecutar = $conexion->db->prepare($sql);
    $ejecutar->bind_param('iidsdi',$idcotizacion,$id_producto,$cantidad_medida,$unidad_medida,$subtotal,$estado);
    $ejecutar->execute();
    
    }

    $conexion->desconectar();
}

//--------------------------------------------------------------------------------------------------------------------
//Funcion mostrar los empleados registrados

    public function ObtenerDetalleCotizacion(){

        $conexion = new conexion();
        $conexion->conectar();
        $detalleCotizacionob = array();
   
        $sql = "SELECT * FROM detalle_cotizacion";
   
        $ejecutar = mysqli_query($conexion->db,$sql);
   
        while($fila = mysqli_fetch_array($ejecutar)){
   
           $detallecotizacionIndex = new DetalleCotizacion();
   
           $detallecotizacionIndex->setIdetallecotizacion($fila[0]);
           $detallecotizacionIndex->setIdcotizacion($fila[1]);
           $detallecotizacionIndex->setIdproducto($fila[2]);
           $detallecotizacionIndex->setCantidadm($fila[3]);
           $detallecotizacionIndex->setUnidadm($fila[4]);
           $detallecotizacionIndex->setPrecio($fila[5]);
           $detallecotizacionIndex->setEstado($fila[6]);

            array_push($detalleCotizacionob,$detallecotizacionIndex);
   
       }
   
       $conexion->desconectar();
       
       return $detalleCotizacionob;

    }

     //-----------------------------------------------------------------------------------------------------------------------------------
    //Funcion Editar Persona

    public function EditarDetalleCotizacion($cantidad_medida,$unidad_medida,$precio,$id_detallecotizacion){ 

        $conexion = new conexion();
        $conexion->conectar();

        $sql = "update detalle_cotizacion set Cantidad_Medida=?, Unidad_Medida=?, Precio=? where id_Detallecotizacion=?";

        $ejecutar = $conexion->db->prepare($sql);

        $ejecutar->bind_param('dsdi',$cantidad_medida,$unidad_medida,$precio,$id_detallecotizacion);

        $ejecutar->execute();

        $conexion->desconectar();

    }


    //------------------------------------------------------------------------------------------------------------------
    //Funcion para buscar las cotizaciones

    public function BuscarDetalleCotizaciones($id_detallecotizacion){

        $conexion = new conexion();
        $conexion->conectar();

        $detallecotizacionArray = new DetalleCotizacion();
        
        $sql = "select * from detalle_Cotizacion where id_detallecotizacion=?";

        $ejecutar = $conexion->db->prepare($sql);

        $ejecutar->bind_param('i',$id_detallecotizacion);

        $ejecutar->execute();

        $resultado = $ejecutar->get_result();

        while($fila = $resultado->fetch_array(MYSQLI_NUM)){

            $detallecotizacionArray->setIdetallecotizacion($fila[0]);
            $detallecotizacionArray->setIdcotizacion($fila[1]);
            $detallecotizacionArray->setIdproducto($fila[2]);
            $detallecotizacionArray->setCantidadm($fila[3]);
            $detallecotizacionArray->setUnidadm($fila[4]);
            $detallecotizacionArray->setPrecio($fila[5]);
            $detallecotizacionArray->setEstado($fila[6]);

        }

        $conexion->desconectar();

        return $detallecotizacionArray;
    }

    //-----------------------------------------------------------------------------------------------------------------------------------
    //Funcion eliminar persona

    public function EliminarDetalleCotizacion($id_detallecotizacion) {
        $conexion = new conexion();
        $conexion->conectar();
    
        // Eliminar el detalle de venta
        $sql = "DELETE FROM detalle_cotizacion WHERE Id_Detallecotizacion = ?";
        $ejecutar = $conexion->db->prepare($sql);
        $ejecutar->bind_param('i', $id_detallecotizacion);
        $ejecutar->execute();

        $conexion->desconectar();
    }
    
    
    public function ValidarDetalleCotizacion($id_cotizacion,$id_producto){   


        $conexion = new conexion();
        $conexion->conectar();
        $estado = 0;

        $sql = "select id_cotizacion,id_producto from detalle_cotizacion where id_cotizacion=? and id_producto=?";

        $ejecutar = $conexion->db->prepare($sql);
        $ejecutar->bind_param('ii', $id_cotizacion,$id_producto);
        $ejecutar->execute();
    
        $resultado = $ejecutar->get_result();

        while($fila = $resultado->fetch_array(MYSQLI_NUM)){
            if(strcmp($fila[0],$id_cotizacion)===0 && strcmp($fila[1],$id_producto)===0){
                $estado=1;
                break;
            }
        }

        $conexion->desconectar();
        return $estado;
    }

    public function ObtenerUltimoIdCotizacion(){
        $conexion = new conexion();
        $conexion->conectar();
    
        $sql = "SELECT MAX(id_cotizacion) FROM cotizacion";
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
    

    public function CalcularTotalCotizacion($id_cotizacion){
        $conexion = new conexion();
        $conexion->conectar();
        $estado=1;
        $total = 0;
        $sql = "SELECT SUM(Precio) AS total FROM detalle_cotizacion WHERE Id_Cotizacion = ? AND Estado=?";
        
        $ejecutar = $conexion->db->prepare($sql);
        $ejecutar->bind_param('ii',$id_cotizacion,$estado);
        $ejecutar->execute();
        
        $resultado = $ejecutar->get_result();
        
        if ($fila = $resultado->fetch_assoc()) {
            $total = $fila['total'];
        }
        
        $conexion->desconectar();
        
        return $total;
    }

}



class Producto2{

    public $cantidad_producto;
    public $descripcion_producto;
    public $estado_producto;
    public $id_categoria;
    public $id_detalle;
    public $id_producto;
    public $nombre_producto;
    public $precioC_producto;
    public $precioV_producto;
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
    public function getPrecioC(){
        return $this->precioC_producto;
    }
    
    public function setPrecioC($_precioC_producto1){
        $this->precioC_producto = $_precioC_producto1;
    }
    public function getPrecioV(){
        return $this->precioV_producto;
    }
    
    public function setPrecioV($_precioV_producto1){
        $this->precioV_producto = $_precioV_producto1;
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
       
               $productoIndex = new Producto2();
       
                   $productoIndex->setIdproducto($fila[0]);
                   //$productoIndex->setIdetalle($fila[1]);
                   $productoIndex->setIdcategoria($fila[1]);
                   $productoIndex->setNombre($fila[2]);
                   $productoIndex->setDescripcion($fila[3]);
                   $productoIndex->setCantidad($fila[4]);
                   $productoIndex->setPrecioC($fila[5]);
                   $productoIndex->setPrecioV($fila[6]);
                   $productoIndex->setUbicacion($fila[7]);
                   $productoIndex->setEstado($fila[8]);
                   
                array_push($productoob,$productoIndex);
       
           }
       
           $conexion->desconectar();
           
           return $productoob;
       
       
           }
        //--------------------------------------------------------------------------------------------------------------------
        //Funcion mostrar los empleados registrados
    
        //------------------------------------------------------------------------------------------------------------------
    //Funcion para buscar las personas

    public function BuscarProducto2($idproducto){

        $conexion = new conexion();
        $conexion->conectar();

        $productoArray = new Producto2();
        $sql = "select * from producto where id_producto=?";

        $ejecutar = $conexion->db->prepare($sql);

        $ejecutar->bind_param('i',$idproducto);

        $ejecutar->execute();

        $resultado = $ejecutar->get_result();

        while($fila = $resultado->fetch_array(MYSQLI_NUM)){

            $productoArray->setIdproducto($fila[0]);
            $productoArray->setNombre($fila[2]);
            $productoArray->setPrecioV($fila[5]); 

        }

        $conexion->desconectar();

        return $productoArray;

    }
    
     
}    
class Usuario{
    public $clave;
    public $estado;
    public $idrol;
    public $idusuario;
    public $nombre;

    //creacion de los metodos get y set

    //----------------------------------------------------------------------------------

    //metodo get y set clave

    public function getClave(){
        return $this->clave;
    }

    public function setClave($_clave1){
        $this->clave = $_clave1;
    }


    //----------------------------------------------------------------------------------
    
    //metodo get y set estado

    public function getEstado(){
        return $this->estado;
    }

    public function setEstado($_estado1){
        $this->estado = $_estado1;
    }


    //---------------------------------------------------------------------------

    //metodo get y set id rol

    public function getIdrol(){
       return $this->idrol;
    }

    public function setIdrol($_idrol1){
        $this->idrol = $_idrol1;
    }

    //-----------------------------------------------------------------------------

    //metodo get y set id usuario

    public function getIdusuario(){

        return $this->idusuario;
    }

    public function setIdusuario($_idusuario1){
        $this->idusuario = $_idusuario1;
    
    }

    //------------------------------------------------------------------------------------
     

    //metodo get y set nombre 

    public function getNombre(){
        return $this-> nombre;

    }

    public function setNombre($_nombre1){
        $this->nombre = $_nombre1;
    }


//funcion visualizar Usuarios
public function ObtenerUsuarios(){
    
$conexion = new conexion();
$conexion->conectar();

$resultadoUsuarios = array();

$sql = "SELECT u.Id_Usuario, r.Nombre, u.Nombre, u.Clave, u.Estado FROM usuario u JOIN rol r on u.Id_Rol=r.Id_Rol";
$ejecutar = mysqli_query($conexion->db,$sql);

while($fila = mysqli_fetch_array($ejecutar)){

    $usuarioIndex = new Usuario();

    $usuarioIndex->setIdusuario($fila[0]);
    $usuarioIndex->setIdrol($fila[1]);
    $usuarioIndex->setNombre($fila[2]);
    $usuarioIndex->setClave($fila[3]);
    $usuarioIndex->setEstado($fila[4]);

    array_push($resultadoUsuarios,$usuarioIndex);

}

$conexion->desconectar();

return $resultadoUsuarios;
}    
}    

?>
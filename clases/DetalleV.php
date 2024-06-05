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

    public function EliminarDetalleV($id_detallev, $idproducto, $cantidadp) {
        $conexion = new conexion();
        $conexion->conectar();
    
        // Eliminar el detalle de venta
        $sql = "DELETE FROM detalle_venta WHERE Id_Detalleventa = ?";
        $ejecutar = $conexion->db->prepare($sql);
        $ejecutar->bind_param('i', $id_detallev);
        $ejecutar->execute();
        $ejecutar->close(); // Cerrar la consulta preparada
    
        // Obtener la cantidad actual del producto
        $sql_cantidad = "SELECT Cantidad FROM producto WHERE Id_Producto = ?";
        $stmt_cantidad = $conexion->db->prepare($sql_cantidad);
        $stmt_cantidad->bind_param('i', $idproducto);
        $stmt_cantidad->execute();
        $cantidad_actual=0;
        $stmt_cantidad->bind_result($cantidad_actual);
        $stmt_cantidad->fetch();
        $stmt_cantidad->close(); // Cerrar la consulta preparada
    
        // Calcular la nueva cantidad
        $nueva_cantidad = $cantidad_actual + $cantidadp;
    
        // Actualizar la cantidad del producto
        $sql_actualizar = "UPDATE producto SET Cantidad = ? WHERE Id_Producto = ?";
        $ejecutar_actualizar = $conexion->db->prepare($sql_actualizar);
        $ejecutar_actualizar->bind_param('ii', $nueva_cantidad, $idproducto);
        $ejecutar_actualizar->execute();
        $ejecutar_actualizar->close(); // Cerrar la consulta preparada
    
        // Desconectar la base de datos
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


    //-----------------------------------------------------------------------------------------------------------------------------------
    //Funcion eliminar empleado o desactivarlo

    public function EliminarVenta1($id_venta){
        $conexion = new conexion();
        $conexion->conectar();

        $estado_venta = 0;
        $sql_update_venta = "UPDATE venta SET estado=? WHERE id_venta=?";
        $stmt_venta = $conexion->db->prepare($sql_update_venta);
        $stmt_venta->bind_param('ii', $estado_venta, $id_venta);
        $stmt_venta->execute();
    
        // Actualizar detalles de venta relacionados
        $estado_detalle = 0;
        $sql_update_detalle = "UPDATE detalle_venta SET estado=? WHERE id_venta=?";
        $stmt_detalle = $conexion->db->prepare($sql_update_detalle);
        $stmt_detalle->bind_param('ii', $estado_detalle, $id_venta);
        $stmt_detalle->execute();

        // Actualizar credito de venta relacionados
        $estado_credito = 0;
        $sql_update_credito = "UPDATE cuentaspor_cobrar SET estado=? WHERE id_venta=?";
        $stmt_credito = $conexion->db->prepare($sql_update_credito);
        $stmt_credito->bind_param('ii', $estado_credito, $id_venta);
        $stmt_credito->execute();
    
        // Sumar la cantidad de productos vendidos nuevamente a la tabla de productos
        $sql_select_detalle = "SELECT Id_Producto, Cantidad_Medida FROM detalle_venta WHERE Id_Venta=?";
        $stmt_select_detalle = $conexion->db->prepare($sql_select_detalle);
        $stmt_select_detalle->bind_param('i', $id_venta);
        $stmt_select_detalle->execute();
        $result_detalle = $stmt_select_detalle->get_result();
    
        while ($row_detalle = $result_detalle->fetch_assoc()) {
            $id_producto = $row_detalle['Id_Producto'];
            $cantidad_medida = $row_detalle['Cantidad_Medida'];
    
            // Actualizar la cantidad del producto en la tabla de productos
            $sql_update_producto = "UPDATE producto SET Cantidad = Cantidad + ? WHERE Id_Producto=?";
            $stmt_producto = $conexion->db->prepare($sql_update_producto);
            $stmt_producto->bind_param('di', $cantidad_medida, $id_producto);
            $stmt_producto->execute();
        }

        $conexion->desconectar();


    }

    //-----------------------------------------------------------------------------------------------------------------------------------------
    //Funcion reactivar a empleado

    public function  ReactivarVenta1($id_venta){
        $conexion = new conexion();
        $conexion->conectar();
        
        $estado_venta = 1;
        $sql_update_venta = "UPDATE venta SET estado=? WHERE id_venta=?";
        $stmt_venta = $conexion->db->prepare($sql_update_venta);
        $stmt_venta->bind_param('ii', $estado_venta, $id_venta);
        $stmt_venta->execute();
    
        // Actualizar detalles de venta relacionados
        $estado_detalle = 1;
        $sql_update_detalle = "UPDATE detalle_venta SET estado=? WHERE id_venta=?";
        $stmt_detalle = $conexion->db->prepare($sql_update_detalle);
        $stmt_detalle->bind_param('ii', $estado_detalle, $id_venta);
        $stmt_detalle->execute();

        // Actualizar credito de venta relacionados
        $estado_credito = 1;
        $sql_update_credito = "UPDATE cuentaspor_cobrar SET estado=? WHERE id_venta=?";
        $stmt_credito = $conexion->db->prepare($sql_update_credito);
        $stmt_credito->bind_param('ii', $estado_credito, $id_venta);
        $stmt_credito->execute();
    
        // Restar la cantidad de productos vendidos de la tabla de productos
        $sql_select_detalle = "SELECT Id_Producto, Cantidad_Medida FROM detalle_venta WHERE Id_Venta=?";
        $stmt_select_detalle = $conexion->db->prepare($sql_select_detalle);
        $stmt_select_detalle->bind_param('i', $id_venta);
        $stmt_select_detalle->execute();
        $result_detalle = $stmt_select_detalle->get_result();
    
        while ($row_detalle = $result_detalle->fetch_assoc()) {
            $id_producto = $row_detalle['Id_Producto'];
            $cantidad_medida = $row_detalle['Cantidad_Medida'];
    
            // Actualizar la cantidad del producto en la tabla de productos
            $sql_update_producto = "UPDATE producto SET Cantidad = Cantidad - ? WHERE Id_Producto=?";
            $stmt_producto = $conexion->db->prepare($sql_update_producto);
            $stmt_producto->bind_param('di', $cantidad_medida, $id_producto);
            $stmt_producto->execute();
        }

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
                   //$productoIndex->setIdetalle($fila[1]);
                   $productoIndex->setIdcategoria($fila[1]);
                   $productoIndex->setNombre($fila[2]);
                   $productoIndex->setDescripcion($fila[3]);
                   $productoIndex->setCantidad($fila[4]);
                   $productoIndex->setPrecio($fila[5]);
                   $productoIndex->setUbicacion($fila[6]);
                   $productoIndex->setEstado($fila[7]);
                   
                array_push($productoob,$productoIndex);
       
           }
       
           $conexion->desconectar();
           
           return $productoob;
       
       
           }
        //--------------------------------------------------------------------------------------------------------------------
        //Funcion mostrar los empleados registrados
    
        //------------------------------------------------------------------------------------------------------------------
    //Funcion para buscar las personas

    public function BuscarProducto1($idproducto){

        $conexion = new conexion();
        $conexion->conectar();

        $productoArray = new Producto1();
        $sql = "select * from producto where id_producto=?";

        $ejecutar = $conexion->db->prepare($sql);

        $ejecutar->bind_param('i',$idproducto);

        $ejecutar->execute();

        $resultado = $ejecutar->get_result();

        while($fila = $resultado->fetch_array(MYSQLI_NUM)){

            $productoArray->setIdproducto($fila[0]);
            $productoArray->setNombre($fila[2]);
            $productoArray->setPrecio($fila[5]); 

        }

        $conexion->desconectar();

        return $productoArray;

    }
//funcion editar Producto 
public function EditarProductoCantidad($cantidad_venta, $Id){

    $conexion = new conexion();
    $conexion->conectar();
  // Obtener la cantidad existente del producto
  $sql_select = "SELECT Cantidad FROM producto WHERE Id_Producto=?";
  $stmt_select = $conexion->db->prepare($sql_select);
  $stmt_select->bind_param('i', $Id);
  $stmt_select->execute();
  $resultado = $stmt_select->get_result();
  $fila = $resultado->fetch_assoc();
  $cantidad_existente = $fila['Cantidad'];
  
  // Restar la cantidad de venta de la cantidad existente
  $nueva_cantidad = $cantidad_existente - $cantidad_venta;

  // Actualizar la cantidad en la base de datos
  $sql_update = "UPDATE producto SET Cantidad=? WHERE Id_Producto=?";
  $stmt_update = $conexion->db->prepare($sql_update);
  $stmt_update->bind_param('di', $nueva_cantidad, $Id);
  $stmt_update->execute();

  $conexion->desconectar();
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
//funcion Buscar Usuario

public function BuscarUsuario($idusuario) {
        $conexion = new conexion();
        $conexion->conectar();
    
        $usuarioArray = array(); // Inicializa un array vacío
    
        $sql = "SELECT * FROM usuario WHERE id_usuario=?";
        $ejecutar = $conexion->db->prepare($sql);
        $ejecutar->bind_param('i', $idusuario);
        $ejecutar->execute();
    
        // Obtiene el resultado de la consulta preparada
        $resultado = $ejecutar->get_result();
    
        // Recorre los resultados y crea objetos Usuario
        while ($fila = $resultado->fetch_array(MYSQLI_NUM)) {
            $usuario = new Usuario(); // Crea un nuevo objeto Usuario
            $usuario->setIdusuario($fila[0]);
            $usuario->setIdrol($fila[1]);
            $usuario->setNombre($fila[2]);
            $usuario->setClave($fila[3]);
            $usuario->setEstado($fila[4]);
            $usuarioArray[] = $usuario; // Agrega el objeto Usuario al array
        }
    
        $conexion->desconectar();
    
        return $usuarioArray;
    }   
}    
?>
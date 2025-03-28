<?php

include("../db/conexion.php");

class Producto{

public $cantidad;
public $descripcion;
public $estado;
public $id_categoria;
public $categoria;
public $id_detalle;
public $id_producto;
public $nombre;
public $pcompra;
public $pventa;
public $ubicacion;

//------------------- creacion de metodos get y set

public function getCantidad(){
    return $this->cantidad;
}

public function setCantidad($_cantidad1){
    $this->cantidad = $_cantidad1;
}

public function getDescripcion(){
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

public function getIdcategoria(){
    return $this->id_categoria;
}
public function setIdcategoria($_idcategoria){
    $this->id_categoria = $_idcategoria;
}

public function getCategoria(){
    return $this->categoria;
}
public function setCategoria($_categoria){
    $this->categoria = $_categoria;
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
    return $this->nombre;
}
public function setNombre($_nombre1){
    $this->nombre = $_nombre1;
}
public function getPcompra(){
    return $this->pcompra;
}

public function setPCompra($_pcompra1){
    $this->pcompra = $_pcompra1;
}
public function getPventa(){
    return $this->pventa;
}

public function setPventa($_pventa1){
    $this->pventa = $_pventa1;
}

public function getUbicacion(){
    return $this->ubicacion;
}

public function setUbicacion($_ubicacion1){
    $this->ubicacion = $_ubicacion1;
}


//funcion guardar Producto
public function GuardarProducto($Idcategoria, $Nombre, $Descripcion, $Cantidad, $Pcompra, $Pventa, $Ubicacion){
        
    $conexion = new conexion();
    $conexion->conectar();
    $estado=1;
    $sql = "insert into producto(Id_Categoria, Nombre, Descripcion, Cantidad, Precio_Compra, Precio_Venta, Ubicacion, Estado) values(?,?,?,?,?,?,?,?)";
    $ejecutar = $conexion->db->prepare($sql);
    $ejecutar->bind_param('ississsi',$Idcategoria, $Nombre, $Descripcion, $Cantidad, $Pcompra, $Pventa, $Ubicacion, $estado);
    $ejecutar->execute();
    
    $conexion->desconectar();
}


//funcion visualizar Producto
public function ObtenerProductos(){
    
    $conexion = new conexion();
    $conexion->conectar();

    $rsProducto = array();

    $sql = "SELECT p.Id_Producto, cp.Nombre, p.Nombre, p.Descripcion, p.Cantidad, p.Precio_Compra, p.Precio_Venta, p.Ubicacion, p.Estado FROM producto p JOIN categoria_producto cp ON p.Id_Categoria=cp.Id_Categoria";
    $ejecutar = mysqli_query($conexion->db,$sql);

    while($fila = mysqli_fetch_array($ejecutar)){

        $ProductoIndex = new Producto();

        $ProductoIndex->setIdproducto($fila[0]);
        $ProductoIndex->setIdcategoria($fila[1]);
        $ProductoIndex->setNombre($fila[2]);
        $ProductoIndex->setDescripcion($fila[3]);
        $ProductoIndex->setCantidad($fila[4]);
        $ProductoIndex->setPcompra($fila[5]);
        $ProductoIndex->setPventa($fila[6]);
        $ProductoIndex->setUbicacion($fila[7]);
        $ProductoIndex->setEstado($fila[8]);

        array_push($rsProducto,$ProductoIndex);

    }

    $conexion->desconectar();
    
    return $rsProducto;
}


//funcion editar Producto
public function EditarProducto($Idcategoria, $Nombre, $Descripcion, $Cantidad, $Pcompra, $Pventa, $Ubicacion, $Id){

  $conexion = new conexion();
  $conexion->conectar();

  $sql = "update producto set Id_Categoria=?, Nombre=?, Descripcion=?, Cantidad=?, Precio_Compra=?, Precio_Venta=?, Ubicacion=? where Id_Producto=?";
  $ejecutar = $conexion->db->prepare($sql);
  $ejecutar->bind_param('ississsi',$Idcategoria, $Nombre, $Descripcion, $Cantidad, $Pcompra, $Pventa, $Ubicacion, $Id);
  $ejecutar->execute();

  $conexion->desconectar();

}


//funcion Buscar Producto
public function BuscarProducto($Idproducto) {
    $conexion = new conexion();
    $conexion->conectar();

    //$productoArray = array(); //Inicializa un array vacío
    $producto = new Producto(); // Crea un nuevo objeto Producto

    $sql = "SELECT p.Id_Producto, p.Id_Categoria, cp.Nombre, p.Nombre, p.Descripcion, p.Cantidad, p.Precio_Compra, p.Precio_Venta, p.Ubicacion, p.Estado FROM producto p JOIN categoria_producto cp ON p.Id_Categoria=cp.Id_Categoria WHERE Id_Producto=?";
    $ejecutar = $conexion->db->prepare($sql);
    $ejecutar->bind_param('i', $Idproducto);
    $ejecutar->execute();

    // Obtiene el resultado de la consulta preparada
    $resultado = $ejecutar->get_result();

    while ($fila = $resultado->fetch_array(MYSQLI_NUM)) {
        //$producto = new Producto(); // Crea un nuevo objeto Producto
        $producto->setIdproducto($fila[0]);
        $producto->setIdcategoria($fila[1]);
        $producto->setCategoria($fila[2]);
        $producto->setNombre($fila[3]);
        $producto->setDescripcion($fila[4]);
        $producto->setCantidad($fila[5]);
        $producto->setPcompra($fila[6]);
        $producto->setPventa($fila[7]);
        $producto->setUbicacion($fila[8]);
        $producto->setEstado($fila[9]);
        //$productoArray[] = $producto; // Agrega el objeto Usuario al array
    }

    $conexion->desconectar();
    return $producto;
}


//Funcion Eliminar Producto
public function EliminarProducto($Idproducto){

    $conexion = new conexion();
    $conexion->conectar();

    $estado = 0;

    $sql = "update producto set Estado=? where Id_Producto=?";
    $ejecutar = $conexion->db->prepare($sql);
    $ejecutar->bind_param('ii',$estado, $Idproducto);
    $ejecutar->execute();

    $conexion->desconectar();

}


//no creo sea ideal reactivar una compra, lo mejor es eliminarla o crear una nueva
//funcion Reactivar Compra
public function ReactivarProducto($Idproducto) {

    $conexion = new conexion();
    $conexion->conectar();

    $estado = 1;

    $sql = "update producto set Estado=? where Id_Producto=?";
    $ejecutar = $conexion->db->prepare($sql);
    $ejecutar->bind_param('ii',$estado, $Idproducto);
    $ejecutar->execute();

    $conexion->desconectar();

}

public function ValidarProducto($Nombre){   

    $conexion = new conexion();
    $conexion->conectar();

    $estado = 0;
    $sql = "SELECT Nombre FROM producto WHERE Nombre=?";
    $ejecutar = $conexion->db->prepare($sql);
    $ejecutar->bind_param('s', $Nombre);

    $ejecutar->execute();
    $resultado = $ejecutar->get_result();

    if ($resultado->num_rows > 0) {
        $estado = 1;
    }

    $conexion->desconectar();

    return $estado;
}




public function ObtenerPersonas(){

    $conexion = new conexion();
    $conexion->conectar();
    $persona = array();

    $sql = "SELECT Id_Persona, Nombre, Nit FROM persona WHERE Tipo='Proveedor' AND Estado=1";
    $ejecutar = mysqli_query($conexion->db,$sql);
    while($fila = mysqli_fetch_array($ejecutar)){

        $personaIndex = new Producto();

        $personaIndex->setIdproducto($fila[0]);
        $personaIndex->setNombre($fila[1]);
        $personaIndex->setIdcategoria($fila[2]);

        array_push($persona,$personaIndex);
   }
   $conexion->desconectar();
   return $persona;
}


public function ObtenerUltimaCompra() {
    $conexion = new conexion();
    $conexion->conectar();
    $rsCompra = array();
    $sql = "SELECT MAX(Id_Compra) FROM compra";
    $ejecutar = mysqli_query($conexion->db, $sql);
    while($fila = mysqli_fetch_array($ejecutar)){
        $compraIndex = new Producto();
        $compraIndex->setIdproducto($fila[0]);
    }
    $conexion->desconectar();
    return $compraIndex;
}

}

?>
<?php

class DetalleC{

public $cantidad;
public $estado;
public $id_compra;
public $id_detallecompra;
public $id_producto;
public $unidad_medida;
public $precio;

public function getCantidad(){
    return $this->cantidad;
}
public function setCantidad($_cantidad){
    $this->cantidad = $_cantidad;
}


public function getEstado(){
    return $this->estado;
}
public function setEstado($_estado1){
    $this->estado = $_estado1;
}


public function getIdcompra(){
    return $this->id_compra;
}
public function setIdcompra($_idcompra){
    $this->id_compra = $_idcompra;
}


public function getIdetalle(){
    return $this->id_detallecompra;
}
public function setIdetalle($_idetallec){
    $this->id_detallecompra = $_idetallec;
}


public function getIdproducto(){
    return $this->id_producto;
}
public function setIdproducto($_idproducto){
    $this->id_producto = $_idproducto;
}


public function getUnidadm(){
    return $this->unidad_medida;
}
public function setUnidadm($_unidadm){
    $this->unidad_medida = $_unidadm;
}


public function getPrecio(){
    return $this->precio;
}
public function setPrecio($_precio){
    $this->precio = $_precio;
}


//funcion guardar
public function GuardarDetalleCompra($conexion, $idcompra, $idproducto, $cantidad, $unidadmedida, $precio){
    $sql = "INSERT INTO detalle_compra (Id_Compra, Id_Producto, Cantidad, Unidad_Medida, Precio) VALUES (?, ?, ?, ?, ?)";
    $ejecutar = $conexion->db->prepare($sql);
    if ($ejecutar) {
        $ejecutar->bind_param('iiiss', $idcompra, $idproducto, $cantidad, $unidadmedida, $precio);
        $ejecutar->execute();
    } else {
        die('Error al preparar la consulta: ' . $conexion->db->error);
    }
}


//funcion visualizar detalles compras
public function ObtenerDetallesCompras($conexion){

    $resultadoDetallesC = array();

    $sql = "SELECT * FROM detalle_compra";
    $ejecutar = mysqli_query($conexion->db,$sql);

    while($fila = mysqli_fetch_array($ejecutar)){

        $detalleC = new DetalleC();
        $detalleC->setIdetalle($fila[0]);
        $detalleC->setIdcompra($fila[1]);
        $detalleC->setIdproducto($fila[2]);
        $detalleC->setCantidad($fila[3]);
        $detalleC->setUnidadm($fila[4]);
        $detalleC->setPrecio($fila[6]);
        $detalleC->setEstado($fila[7]);

        array_push($resultadoDetallesC,$detalleC);
    }

    $conexion->desconectar();   
    return $resultadoDetallesC;
}


//funcion editar Detalle Compra
public function EditarDetalleCompra($conexion, $idcompra, $idproducto, $cantidad, $unidadmedida, $cantidadmedida){

    /*$conexion = new conexion();
    $conexion->conectar();*/

    $sql = "update detalle_compra set Id_Compra=?, Id_Producto=?, Cantidad=?, Unidad_Medida=? where Id_Detallecompra=?";
    $ejecutar = $conexion->db->prepare($sql);
    $ejecutar->bind_param('iiis',$idcompra, $idproducto, $cantidad, $unidadmedida);
    $ejecutar->execute();

    $conexion->desconectar();
}


//funcion Buscar Detalle Compra
public function BuscarDetalleCompra($conexion, $id_DetalleC) {
    
    $detalleCArray = array(); // Inicializa un array vacío

    $sql = "SELECT dc.Id_Detallecompra, dc.Id_Compra, p.Nombre, dc.Cantidad, dc.Unidad_Medida, dc.Precio, dc.Estado FROM detalle_compra dc JOIN producto p ON dc.Id_Producto=p.Id_Producto WHERE Id_Compra=?";
    $ejecutar = $conexion->db->prepare($sql);
    $ejecutar->bind_param('i', $id_DetalleC);
    $ejecutar->execute();

    // Obtiene el resultado de la consulta preparada
    $resultado = $ejecutar->get_result();

    // Recorre los resultados y crea objetos Compra
    while ($fila = $resultado->fetch_array(MYSQLI_NUM)) {
        $detalleC = new DetalleC(); // Crea un nuevo objeto Compra
        $detalleC->setIdetalle($fila[0]);
        $detalleC->setIdcompra($fila[1]);
        $detalleC->setIdproducto($fila[2]);
        $detalleC->setCantidad($fila[3]);
        $detalleC->setUnidadm($fila[4]);
        $detalleC->setPrecio($fila[5]);
        $detalleC->setEstado($fila[6]);
        $detalleCArray[] = $detalleC; // Agrega el objeto Usuario al array
    }

    $conexion->desconectar();
    return $detalleCArray;
}


//Funcion Eliminar Compra
public function EliminarDetalleCompra($conexion, $id_DetalleC){

    $estado = 0;

    $sql = "update detalle_compra set Estado=? where id_Detallecompra=?";
    $ejecutar = $conexion->db->prepare($sql);
    $ejecutar->bind_param('ii',$estado, $id_DetalleC);
    $ejecutar->execute();

    $conexion->desconectar();
}


//no creo sea ideal reactivar una compra, lo mejor es eliminarla o crear una nueva
//funcion Reactivar Compra
public function ReactivarDetalleCompra($conexion, $id_DetalleC) {

    $estado = 1;

    $sql = "update detalle_compra set Estado=? where id_Detallecompra=?";
    $ejecutar = $conexion->db->prepare($sql);
    $ejecutar->bind_param('ii',$estado, $id_DetalleC);
    $ejecutar->execute();

    $conexion->desconectar();
}


}
?>
<?php

/*include("../db/conexion.php");
include("DetalleC.php");*/


class Compra{

public $estado;
public $fecha;
public $id_compra;
public $id_proveedor;
public $id_usuario;
public $impuesto;
public $n_comprobante;
public $serie_c;
public $tipo_c;
public $total;

//----------------------- creacion de metodo get y set-------------------------------
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

public function getIdcompra(){
    return $this->id_compra;
}
public function setIdcompra($_idcompra){
    $this->id_compra = $_idcompra;
}


public function getIdproveedor(){
    return $this->id_proveedor;
}
public function setIdproveedor($_idproveedor){
    $this->id_proveedor = $_idproveedor;
}


public function getIdusuario(){
    return $this->id_usuario;
}
public function setIdusuario($_idusuario){
    $this->id_usuario = $_idusuario;
}


public function getImpuesto(){
    return $this->impuesto;
}
public function setImpuesto($_impuesto1){
    $this->impuesto = $_impuesto1;
}


public function getComprobante(){
    return $this->n_comprobante;
}
public function setComprobante($_ncomprobante){
    $this->n_comprobante = $_ncomprobante;
}


public function getSerie(){
    return $this->serie_c;
}
public function setSerie($_serie1){
    $this->serie_c = $_serie1;
}

public function getTipo(){
    return $this->tipo_c;
}
public function setTipo($_tipo1){
    $this->tipo_c = $_tipo1;
}


public function getTotal(){
    return $this->total;
}
public function setTotal($_total1){
    $this->total = $_total1;
}


//funcion guardar
public function GuardarCompra($conexion,$idusuario, $idproveedor, $tipocomprobante, $numcomprobante, $seriecomprobante, $impuesto, $total){
        
    $sql = "insert into compra(Id_Usuario, Id_Proveedor, Tipo_Comprobante, Num_Comprobante, Serie_Comprobante, Impuesto, Total) values(?,?,?,?,?,?,?)";
    $ejecutar = $conexion->db->prepare($sql);
    if (!$ejecutar) {
        die('Error al preparar la consulta: ' . $conexion->db->error);
    }
    $ejecutar->bind_param('iisisii', $idusuario, $idproveedor, $tipocomprobante, $numcomprobante, $seriecomprobante, $impuesto, $total);
    $resultado = $ejecutar->execute();
    if (!$resultado) {
        die('Error al ejecutar la consulta: ' . $conexion->db->error);
    }
}


//funcion visualizar compras
public function ObtenerCompras($conexion){

    $resultadoCompras = array();

    $sql = "SELECT c.Id_Compra, u.Nombre, p.Nombre, c.Tipo_Comprobante, c.Num_Comprobante, c.Serie_Comprobante, c.Fecha, c.Impuesto, c.Total, c.Estado FROM compra c JOIN usuario u ON c.Id_Usuario=u.Id_Usuario JOIN persona p ON c.Id_Proveedor=p.Id_Persona";
    $ejecutar = mysqli_query($conexion->db,$sql);

    while($fila = mysqli_fetch_array($ejecutar)){

        $compraIndex = new Compra();

        $compraIndex->setIdcompra($fila[0]);
        $compraIndex->setIdusuario($fila[1]);
        $compraIndex->setIdproveedor($fila[2]);
        $compraIndex->setTipo($fila[3]);
        $compraIndex->setComprobante($fila[4]);
        $compraIndex->setSerie($fila[5]);
        $compraIndex->setFecha($fila[6]);
        $compraIndex->setImpuesto($fila[7]);
        $compraIndex->setTotal($fila[8]);
        $compraIndex->setEstado($fila[9]);

        array_push($resultadoCompras,$compraIndex);

    }

    $conexion->desconectar();
    
    return $resultadoCompras;
}


//funcion editar Compra
public function EditarCompra($conexion,$idproveedor, $tipocomprobante, $numcomprobante, $seriecomprobante, $impuesto, $total, $id_compra){

  /*$conexion = new conexion();
  $conexion->conectar();*/

  $sql = "update compra set Id_Proveedor=?, Tipo_Comprobante=?, Num_Comprobante=?, Serie_Comprobante=?, Impuesto=?, Total=? where Id_Compra=?";
  $ejecutar = $conexion->db->prepare($sql);
  $ejecutar->bind_param('isisiss',$idproveedor, $tipocomprobante, $numcomprobante, $seriecomprobante, $impuesto, $total, $id_compra);
  $ejecutar->execute();

  $conexion->desconectar();

}


//funcion Buscar Compra
public function BuscarCompra($conexion,$id_compra) {
    
    $compraArray = array(); // Inicializa un array vacío
    $compra = new Compra(); // Crea un nuevo objeto Compra

    $sql = "SELECT c.Id_Compra, u.Nombre, p.Nombre, c.Tipo_Comprobante, c.Num_Comprobante, c.Serie_Comprobante, c.Fecha, c.Impuesto, c.Total, c.Estado FROM compra c JOIN usuario u ON c.Id_Usuario=u.Id_Usuario JOIN persona p ON c.Id_Proveedor=p.Id_Persona WHERE Id_Compra=?";
    $ejecutar = $conexion->db->prepare($sql);
    $ejecutar->bind_param('i', $id_compra);
    $ejecutar->execute();

    // Obtiene el resultado de la consulta preparada
    $resultado = $ejecutar->get_result();

    // Recorre los resultados y crea objetos Compra
    while ($fila = $resultado->fetch_array(MYSQLI_NUM)) {
        //$compra = new Compra(); // Crea un nuevo objeto Compra
        $compra->setIdcompra($fila[0]);
        $compra->setIdusuario($fila[1]);
        $compra->setIdproveedor($fila[2]);
        $compra->setTipo($fila[3]);
        $compra->setComprobante($fila[4]);
        $compra->setSerie($fila[4]);
        $compra->setFecha($fila[4]);
        $compra->setImpuesto($fila[4]);
        $compra->setTotal($fila[4]);
        $compra->setEstado($fila[4]);
        //$compraArray[] = $compra; // Agrega el objeto Usuario al array
    }

    return $compra;
}


//Funcion Eliminar Compra
public function EliminarCompra($conexion,$id_compra){

    /*$conexion = new conexion();
    $conexion->conectar();*/

    $estado = 0;

    $sql = "update compra set Estado=? where id_Compra=?";
    $ejecutar = $conexion->db->prepare($sql);
    $ejecutar->bind_param('ii',$estado, $id_compra);
    $ejecutar->execute();

    $conexion->desconectar();

}


//no creo sea ideal reactivar una compra, lo mejor es eliminarla o crear una nueva
//funcion Reactivar Compra
public function ReactivarCompra($conexion,$id_compra) {

    /*$conexion = new conexion();
    $conexion->conectar();*/

    $estado = 1;

    $sql = "update compra set Estado=? where id_Compra=?";
    $ejecutar = $conexion->db->prepare($sql);
    $ejecutar->bind_param('ii',$estado, $id_compra);
    $ejecutar->execute();

    $conexion->desconectar();

}


public function ObtenerUltimaCompra($conexion) {
    /*$conexion = new conexion();
    $conexion->conectar();*/
    $rsCompra = array();
    $sql = "SELECT MAX(Id_Compra) FROM compra";
    $ejecutar = mysqli_query($conexion->db, $sql);
    while($fila = mysqli_fetch_array($ejecutar)){
        $compraIndex = new Compra();
        $compraIndex->setIdcompra($fila[0]);
    }
    $conexion->desconectar();
    return $compraIndex;
}


}

?>
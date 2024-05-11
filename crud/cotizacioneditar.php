<?php 
include("../clases/Cotizacion.php");

if(isset($_POST["btnEditarCotizacion"])){  


$cotizacion = new cotizacion();

$id_cotizacion = $_POST['id_cotizacion'];
$subtotal = $_POST['sub_total'];
$descuento = $_POST['descuento'];


if($cotizacion->ValidarCotizacion2($id_cotizacion)==0){
    
    $total = $subtotal-$descuento;
    
$cotizacion->EditarCotizacion($descuento,$total,$id_cotizacion);

    header("Location: ../vistas/Cotizacion.php");


}else{

        
    header("Location: ../vistas/Cotizacion_editar.php?id=$id_cotizacion&mensaje=existe");

}

}
?>
<script>
// Cuando el usuario retrocede en el navegador, redirigir a otra ruta
window.history.pushState(null, null, '../vistas/Cotizacion.php');
</script>
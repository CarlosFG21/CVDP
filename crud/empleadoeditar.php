<?php 

include("../clases/Empleado.php");

if(isset($_POST["btnEditarEmpleado"])){  


$empleado = new Empleado();

$id = $_REQUEST['id'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$edad = $_POST['edad'];
$puesto = $_POST['puesto'];
$salario = $_POST['salario'];
$fecha_ent = $_POST['fecha_ent'];
//$id_usuario = $_POST['id_usuario'];

if($empleado->ValidarEmpleado($nombre,$apellido)==0){

$empleado->EditarEmpleado($nombre, $apellido, $edad,$puesto,$salario, $fecha_ent,$id);

header("Location: ../vistas/Empleado.php");

}else{

        
    header("Location: ../vistas/empleado_editar.php?id=$id&mensaje=existe");

}


}





?>
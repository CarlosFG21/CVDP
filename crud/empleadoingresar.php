<?php

include("../clases/empleado.php");

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$edad = $_POST['edad'];
$puesto = $_POST['puesto'];
$salario = $_POST['salario'];
$fecha_ent = $_POST['fecha_ent'];
$id_usuario = $_POST['id_usuario'];
$estado = $_POST['estado'];

$empleado = new Empleado();


if(isset($_POST["btnGuardarEmpleado"])){

  if($empleado->ValidarEmpleado($nombre,$apellido)==0){

  $empleado->GuardarEmpleado($id_usuario,$nombre,$apellido,$edad,$puesto,$salario,$fecha_ent,$estado);

  header("Location: ../vistas/empleado.php");

}else{

  header("Location: ../vistas/empleado_ingresar.php?mensaje=existe");

}


}


?>
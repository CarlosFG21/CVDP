<?php

include("../clases/Persona.php");

$tipo = $_POST['tipo'];
$nombre = $_POST['nombre'];
$nit = $_POST['nit'];

$persona = new Persona();


if(isset($_POST["btnGuardarPersona"])){

  if($persona->ValidarPersona($nombre,$tipo)==0){

  $persona->GuardarPersona($tipo,$nombre,$nit);

  header("Location: ../vistas/persona.php");

}else{

  header("Location: ../vistas/persona_ingresar.php?mensaje=existe");

}


}



?>
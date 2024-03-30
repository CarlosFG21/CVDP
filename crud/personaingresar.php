<?php

include("../clases/Persona.php");

$tipo = $_POST['tipo'];
$nombre = $_POST['nombre'];
$nit = $_POST['nit'];

$persona = new Persona();


if(isset($_POST["btnGuardarPersona"])){

  $persona->GuardarPersona($tipo,$nombre,$nit);

  header("Location: ../vistas/persona.php");


}



?>
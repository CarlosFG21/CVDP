<?php 

include("../clases/Persona.php");

if(isset($_POST["btnEditarPersona"])){  


$persona = new Persona();

$id = $_REQUEST['id'];
$tipo = $_POST['tipo'];
$nombre = $_POST['nombre'];
$nit = $_POST['nit'];

if($persona->ValidarPersona($nombre,$tipo)==0){

$persona->EditarPersona($tipo,$nombre,$nit,$id);

header("Location: ../vistas/persona.php");

}else{

        
    header("Location: ../vistas/persona_editar.php?id=$id&mensaje=existe");

}


}





?>
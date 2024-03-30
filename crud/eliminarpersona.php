<?php
    include("../clases/Persona.php");

    $persona = new Persona();
    $id = $_REQUEST['id'];

    $persona->EliminarPersona($id);
    header("Location: ../vistas/persona.php");

?>
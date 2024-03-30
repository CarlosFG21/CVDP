<?php
    include("../clases/Persona.php");

    $persona = new Persona();
    $id = $_REQUEST['id'];

    $persona->ReactivarPersona($id);
    header("Location: ../vistas/persona.php");

?>
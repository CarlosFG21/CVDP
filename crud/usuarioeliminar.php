<?php
    include("../clases/Usuario.php");

    $usuario = new Usuario();
    $id = $_REQUEST['id'];

    $usuario->EliminarUsuario($id);
    header("Location: ../vistas/usuario.php");

?>
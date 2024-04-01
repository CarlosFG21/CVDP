<?php
    include("../clases/Empleado.php");

    $empleado = new Empleado();
    $id = $_REQUEST['id'];

    $empleado->EliminarEmpleado($id);
    header("Location: ../vistas/empleado.php");

?>
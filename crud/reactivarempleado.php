<?php
    include("../clases/Empleado.php");

    $empleado = new Empleado();
    $id = $_REQUEST['id'];

    $empleado->ReactivarEmpleado($id);
    header("Location: ../vistas/Empleado.php");

?>
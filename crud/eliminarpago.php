<?php

include("../clases/Planilla.php");

$planilla = new Planilla();

$id = $_REQUEST['id'];

$planilla->CancelarPago($id);

header("Location: ../vistas/planilla.php");


?>
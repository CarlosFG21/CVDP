<?php
	include('../db/conexion.php');

	session_start();

	$nombre = $_POST['nombre'];
	$clave = $_POST['clave'];

	$sql = "SELECT * FROM usuarios WHERE Nombre= '$nombre'";
	$resultado = $conexion->query($sql);

	$fila = $resultado->fetch_assoc();
	
	if (!$fila) {
        ?><script> alert('Usuario o contraseña invalido');
		location.href = "../vistas/login.php";</script><?php
    } else {
        if (password_verify($clave, $fila['Clave'])) {
			$_SESSION['nombre'] = $nombre;
			$_SESSION['tipo'] = $fila['Tipo'];
			$_SESSION['id'] = $fila['Id'];
			echo "<script> alert('".$_SESSION['tipo']."'); </script>";
			header("Location: ../vistas/index.php");
        } else {
            ?><script> alert('Contraseña invalida');
			location.href = "../vistas/login.php";</script><?php
        }
    }
?>
<?php
	include('../db/conexion.php');

	session_start();

	$conexion = new conexion();
	$conexion->conectar();

	$usuario = $_POST['usuario'];
	$contraseña = $_POST['contraseña'];

	$sql = "SELECT u.Id_Usuario, r.Nombre AS Tipo, u.Nombre, u.Clave FROM usuario u JOIN rol r ON u.Id_Rol = r.Id_Rol WHERE u.Nombre = ? AND u.Estado=1";
	$stmt = $conexion->db->prepare($sql);
	$stmt->bind_param("s", $usuario);
	$stmt->execute();
	$resultado = $stmt->get_result();

	if ($resultado->num_rows > 0) {
		$fila = $resultado->fetch_assoc();
		if (password_verify($contraseña, $fila['Clave'])) {
			$_SESSION['nombre'] = $usuario;
			$_SESSION['tipo'] = $fila['Tipo'];
			$_SESSION['id'] = $fila['Id_Usuario'];
			echo "<script> alert('".$_SESSION['tipo']."'); </script>";
			header("Location: ../vistas/index.php");
			//exit(); // Es una buena práctica salir después de redirigir
		} else {
			?><script>
				alert('Contraseña invalida');
				location.href = "../vistas/login.php";
			</script><?php
		}
	} else {
		?><script>
			alert('Usuario o contraseña invalido');
			location.href = "../vistas/login.php";
		</script><?php
	}
	
	// Redirigir con un mensaje de error, si es necesario
	if (isset($mensaje)) {
		header("Location: ../vistas/login.php");
		exit();
	}	

	// Cerrar la conexión
	$conexion->desconectar();
?>
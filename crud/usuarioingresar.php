<?php

    include("../clases/Usuario.php");

    if(isset($_POST["btnGuardar"])){
        
        $nombre = $_POST['txt_nombreu'];
        $rol = $_POST['sl_rol'];
        $clave = $_POST['txt_contraseña'];
        $clave_conf = $_POST['txt_confir_contraseña'];
        $clave_hash = password_hash($clave, PASSWORD_BCRYPT);
    
        $usuarioclass = new Usuario();
            
        if ($clave==$clave_conf) {

            if($usuarioclass->ValidarUsuario($nombre)==0){
                $usuarioclass->GuardarUsuario($rol,$nombre,$clave_hash);
                header("Location: ../vistas/usuario.php");
            }else{
                //header("Location: ../vistas/usuario.php?mensaje=El usuario ya existe");
                ?><script>
				    alert('El usuario ya existe');
				    location.href = "../vistas/usuario.php";
			    </script><?php
            }
        }
        else {
            ?><script>
                alert('Las contraseñas no son iguales');
                location.href = "../vistas/usuario.php";
            </script><?php
        }
    }

    if(isset($_POST["btnCancelar"])){
        header("Location: ../vistas/usuario.php");
    }


    //actualizacion de usuario
    if(isset($_POST["btnActualizar"])){

        $usuario = new Usuario();
        $id = $_REQUEST['idusuarioUAc'];
        $rol =  $_POST['sl_rolAc'];
        $nombre =  $_POST['nombreUAc'];
        $clave =  $_POST['contraseñaAc'];
        $clave_hash = password_hash($clave, PASSWORD_BCRYPT);

            $usuario->EditarUsuario($id,$rol,$nombre,$clave_hash);
            header("Location: ../vistas/usuario.php");
    }


    if(isset($_POST["btnCancelarAc"])){
        header("Location: ../vistas/usuario.php");
    }

?>
<?php
    include("layout/header.php");
    include("layout/nav.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USUARIO</title>
</head>

<body>
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content-header">
            </section>
            <section class="content">
                <div class="container-fluid">

                    <div class="card card-warning">
                        <div class="card-header">
                            <h1 class="card-title">NUEVO USUARIO</h1>
                        </div>

                        <?php
                            $id = $_REQUEST['id'];
                            include("../clases/Usuario.php");
                            $usuario = new Usuario();
                            $usuarioArray = $usuario->BuscarUsuario($id);

                                for($i=0; $i<sizeof($usuarioArray); $i++){
                        ?>

                        <!-- form start -->
                        <form method="post" action="../crud/usuarioingresar.php">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="idusuarioUAc">Id</label>
                                            <input type="text" class="form-control" id="idusuarioUAc" name="idusuarioUAc"
                                            readonly value="<?php echo $usuarioArray[$i]->getIdusuario(); ?>">
                                        </div>    
                                        <div class="col-sm-6">
                                            <!--div class="form-group"-->
                                                <label for="sl_rolAc">Rol de Usuario</label>
                                                <select name="sl_rolAc" id="sl_rolAc" name="sl_rolAc" class="form-control">
                                                    <option value="1">Administrador</option>
                                                    <option value="2">Usuario</option>
                                                </select>
                                            <!--/div-->
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="nombreUAc">Nombre</label>
                                            <input type="text" class="form-control" id="nombreUAc" name="nombreUAc"
                                            value="<?php echo $usuarioArray[$i]->getNombre(); ?>" required autofocus>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="contraseñaAc">Contraseña</label>
                                            <input type="password" class="form-control" id="contraseñaAc" name="contraseñaAc"
                                            placeholder="Contraseña" required autofocus>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <button type="submit" class="btn btn-block bg-gradient-primary" name="btnActualizar">
                                        <i class="fa fa-save"></i> Actualizar</button>
                                    </div>
                                    <div class="col-sm-6">
                                        <button type="submit" class="btn btn-block bg-gradient-danger" name="btnCancelarAc">
                                        <i class="fa fa-ban"></i> CANCELAR</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <?php
                            }
                        ?>
                    </div>


                    <div class="card card-warning">
                        <div class="card-header">
                            <h1 class="card-title">USUARIOS</h1>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12">

                                        <!--table id="bootstrap-data-table" class="table table-striped table-bordered"-->
                                        <table id="example1" class="table table-bordered table-striped dataTable dtr-inline"
                                        aria-describedby="example1_info">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Rol</th>
                                                    <th>Nombre</th>
                                                    <th>Estado</th>
                                                    <th>Editar</th>
                                                    <th>Eliminar</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                    //include("../clases/Usuario.php");
                                                    $usuario = new Usuario();
                                                    $usuarioArray = $usuario->ObtenerUsuarios();

                                                    for($i=0; $i<sizeof($usuarioArray); $i++){
                                                
                                                        $id = $usuarioArray[$i]->getIdusuario();
                                                        $idrol = $usuarioArray[$i]->getIdrol();
                                                        $nombre = $usuarioArray[$i]->getNombre();
                                                        $estado = $usuarioArray[$i]->getEstado();

                                                        echo "<tr>
                                                        <td>$id</td>
                                                        <td>$idrol</td>
                                                        <td>$nombre</td>";
                                                        if($estado==1){
                                                            echo "<td><h4><span class='badge bg-success'>Activo</span></h4></td>";
                                                        }else{
                                                            echo "<td><h4><span class='badge bg-danger'>Inactivo</span></h4></td>";
                                                        }
                                                        echo "<td><a href='usuario_editar.php?id=$id' class='btn btn-success btn-sm'><i class='fa fa-edit fa-lg'></i></a></td>
                                                        <td><a href='../clases/Eliminaru.php?id=$id' class='btn btn-danger btn-sm'><i class='fa fa-trash fa-lg'></i></a></td>
                                                        </tr>";
                                                    }
                                                ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>

</html>

<?php 
    include("layout/footer.php"); 
?>

<script type="text/javascript">
$(document).ready(function() {
    $('#bootstrap-data-table-export').DataTable();
});
</script>
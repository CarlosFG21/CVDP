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
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>REGISTRO DE NUEVO USUARIO</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Registro de usuarios</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="card card-primary">
        <!-- /.card-header -->
        <!-- form start -->
        <form>
            <div class="card-body">
                <div class="form-group">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-10">
                        <label for="nombre_usuario">Nombre</label>
                        <input type="text" class="form-control" id="nombre_usuario" placeholder="Nombre usuario">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-10">
                        <label for="contraseña">Contraseña</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Contraseña">
                    </div>
                </div>

                <div class="btn-registrar">
                    <button type="submit" class="btn btn-primary">REGISTRAR USUARIO</button>
                </div>
            </div>
        </form>
    </div>
</div>
</body>
</html>

<?php 
include("layout/footer.php"); ?>


<?php 
	session_start();
	$usuario = $_SESSION['nombre'];
    $tipo = $_SESSION['tipo'];

	if (isset($_SESSION['nombre'])) {
?>

<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="../app/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet"
    href="../app/AdminLTE-3.2.0/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
<!-- iCheck -->
<link rel="stylesheet" href="../app/AdminLTE-3.2.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<!-- JQVMap -->
<link rel="stylesheet" href="../app/AdminLTE-3.2.0/plugins/jqvmap/jqvmap.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="../app/AdminLTE-3.2.0/dist/css/adminlte.min.css">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="../app/AdminLTE-3.2.0/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
<!-- Daterange picker -->
<link rel="stylesheet" href="../app/AdminLTE-3.2.0/plugins/daterangepicker/daterangepicker.css">
<!-- summernote -->
<link rel="stylesheet" href="../app/AdminLTE-3.2.0/plugins/summernote/summernote-bs4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="../app/AdminLTE-3.2.0/dist/img/AdminLTELogo.png" alt="AdminLTELogo"
                height="60" width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->


                <!-- Messages Dropdown Menu -->

            </ul>

            <header id="header" class="header">
                <!-- Header-->
                <div class="top-right">
                    <div class="header-menu">
                        <div class="header-left">
                            <!--para mostrar el usuario conectado-->
                            <div class="user-area dropdown float-right">
                                <a href="#" class="active" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <img class="img-size-50 img-circle" src="../app/AdminLTE-3.2.0/dist/img/Mia.png"
                                        alt="User Avatar">
                                </a>
                                <div class="user-menu dropdown-menu">
                                    <a class="nav-link"><?php echo 'Bienvenido '.$usuario; ?> </a>
                                    <a class="nav-link" href="#"><i class="fa fa-user"></i><?php echo $tipo; ?></a>
                                    <a class="nav-link" href="../clases/salir.php"><i class="fa fa-power-off"></i>Cerrar
                                        Session</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header><!-- /#header -->
        </nav><!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="../app/AdminLTE-3.2.0/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">CVDP / San Diego</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <?php
                          
                          //matriz de elementos de menú comunes para todos los usuarios
                          $commonMenuItems = array(
                              array('href' => 'index.php', 'icon' => 'fa fa-home', 'text' => 'Inicio'),
                              array('href' => 'venta.php', 'icon' => 'fas fa-id-card', 'text' => 'Venta')
                          );

                          //matriz de elementos de menú para administradores
                          $adminMenuItems = array(
                              array('href' => 'categoria_producto.php', 'icon' => 'fas fa-braille', 'text' => 'Categoria Productos'),
                              array('href' => 'persona.php', 'icon' => 'fas fa-male', 'text' => 'Clientes / Proveedores'),
                              array('href' => 'rol.php', 'icon' => 'fas fa-clone', 'text' => 'Roles'),
                              array('href' => 'usuario.php', 'icon' => 'fas fa-user', 'text' => 'Usuarios'),
                              array('href' => 'empleado.php', 'icon' => 'fas fa-child', 'text' => 'Empleado'),
                              array('href' => 'gasto.php', 'icon' => 'fas fa-university', 'text' => 'Gastos'),
                              array('href' => 'planilla.php', 'icon' => 'fas fa-file', 'text' => 'Planilla'),
                              array('href' => 'producto.php', 'icon' => 'fas fa-table', 'text' => 'Producto'),
                              array('href' => 'compra.php', 'icon' => 'fa fa-shopping-bag', 'text' => 'Compras')
                              
                          );

                          // Iterar sobre los elementos de menú comunes y generar HTML
                          foreach ($commonMenuItems as $menuItem) {
                              echo "<li class='nav-item'><a href='{$menuItem['href']}' class='nav-link'><i class='nav-icon {$menuItem['icon']}'></i><p>{$menuItem['text']}</p></a></li>";
                          }

                          // Si el usuario es un administrador, se mostra los elementos de menú adicionales
                          if ($tipo == 'Administrador') {
                              foreach ($adminMenuItems as $menuItem) {
                                  echo "<li class='nav-item'><a href='{$menuItem['href']}' class='nav-link'><i class='nav-icon {$menuItem['icon']}'></i><p>{$menuItem['text']}</p></a></li>";
                              }
                          }
                        ?>

                    </ul>

                </nav><!-- /.sidebar-menu -->
            </div><!-- /.sidebar -->
        </aside>



        <?php
	    }else{
		    header('Location: ../vistas/login.php');
	    }
    ?>
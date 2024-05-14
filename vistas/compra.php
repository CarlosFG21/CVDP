<?php
    include("layout/header.php");
?>

<title>CVDP|San Diego </title>

<?php
    include("layout/nav.php");
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Compras</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">

                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a type="submit" class="btn btn-success" href="compra_ingresar.php"> 
                            <i class="nav-icon fas fa-plus"> Registrar Compra </i></a>
                            <a type="submit" class="btn btn-danger" target="_blank" href="../reportes/reporte_compra.php"> <i class="nav-icon fas fa-file"> Generar Reporte</i></a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Usuario</th>
                                        <th>Proveedor</th>
                                        <th>Tipo Comprobante</th>
                                        <th>No. Comprobante</th>
                                        <th>Serie Comprobante</th>
                                        <th>Fecha</th>
                                        <th>Impuesto</th>
                                        <th>Total</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        include("../db/conexion.php");
                                        include("../clases/Compra.php");
                                        $conexion = new conexion();
                                        $conexion->conectar();
                                        $compra = new Compra();
                                        $compraArray = $compra->ObtenerCompras($conexion);

                                        for($i=0; $i<sizeof($compraArray); $i++){
                                        
                                            $idcompra = $compraArray[$i]->getIdcompra();
                                            $usuario = $compraArray[$i]->getIdusuario();
                                            $proveedor = $compraArray[$i]->getIdproveedor();
                                            $tipo_compro = $compraArray[$i]->getTipo();
                                            $no_compro = $compraArray[$i]->getComprobante();
                                            $serie_compro = $compraArray[$i]->getSerie();
                                            $fecha = $compraArray[$i]->getFecha();
                                            $impuesto = $compraArray[$i]->getImpuesto();
                                            $total = $compraArray[$i]->getTotal();
                                            $estado = $compraArray[$i]->getEstado();

                                            echo "<tr>
                                                <td>$idcompra</td>
                                                <td>$usuario</td>
                                                <td>$proveedor</td>
                                                <td>$tipo_compro</td>
                                                <td>$no_compro</td>
                                                <td>$serie_compro</td>
                                                <td>$fecha</td>
                                                <td>$impuesto</td>
                                                <td>$total</td>";

                                                if($estado==1){
                                                    echo "<td><h4><span class='badge bg-success'>Activo</span></h4></td>";
                                                }else{
                                                    echo "<td><h4><span class='badge bg-danger'>Inactivo</span></h4></td>";
                                                }
                                                echo "<td><a type='submit' href='detallecompra_visualizar.php?id=$idcompra'class='btn bg-gradient-primary' title='Visualizar'>
                                                <i class='fas fa-eye'></i>
                                                </a></td>";
                                            echo "</tr>";
                                        }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Usuario</th>
                                        <th>Proveedor</th>
                                        <th>Tipo Comprobante</th>
                                        <th>Num Comprobante</th>
                                        <th>Serie Comprobante</th>
                                        <th>Fecha</th>
                                        <th>Impuesto</th>
                                        <th>Total</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>


<?php
    include("layout/footer.php");
?>
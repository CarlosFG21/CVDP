<?php
  include("layout/header.php");
?>

<title>CVDP | San Diego</title>

<?php
  include("layout/nav.php");
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Productos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Editar</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <?php
            
                include("../clases/Producto.php");
                $producto = new Producto();
              
                $id = $_REQUEST['id'];
                $productoArray = $producto->BuscarProducto($id);

                $id_categoria = $productoArray->getIdcategoria();
                $categoria = $productoArray->getCategoria();
                $nombre = $productoArray->getNombre();
                $descripcion = $productoArray->getDescripcion();
                $cantidad = $productoArray->getCantidad();
                $pcompra = $productoArray->getPcompra();
                $pventa = $productoArray->getPventa();
                $ubicacion = $productoArray->getUbicacion();
                $estado = $productoArray->getEstado();
 
              ?>
                <form role="form" method="post" action="../crud/productoeditar.php?id=<?php echo $id;?>">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>ID</label>
                        <?php echo "<input type='number' class='form-control' readonly value='$id' name='id' id='id'>";?>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Categoria</label>
                        <select name="categoria" id="categoria" class="form-control">
                        <?php echo '<option value='.$id_categoria.'>'.$categoria.'</option>';?>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Producto</label>
                        <?php echo "<input type='text' class='form-control' value='$nombre' name='nombre' id='nombre'
                        required minlength='3' maxlength='60'>";?>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Descripcion</label>
                        <?php echo "<input type='text' class='form-control' value='$descripcion' name='descripcion' id='descripcion'
                        required minlength='3' maxlength='60'>";?>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Cantidad</label>
                        <?php echo "<input type='number' class='form-control' value='$cantidad' name='cantidad' id='cantidad' readonly>";?>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Precio Compra</label>
                        <?php echo "<input type='text' class='form-control' value='$pcompra' name='pcompra' id='pcompra'
                        required maxlength='10'>";?>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Precio Venta</label>
                        <?php echo "<input type='text' class='form-control' value='$pventa' name='pventa' id='pventa'
                        required maxlength='10'>";?>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Ubicacion</label>
                        <?php echo "<input type='text' class='form-control' value='$ubicacion' name='ubicacion' id='ubicacion'
                        required minlength='1' maxlength='10'>";?>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Estado</label>
                        <?php if ($estado==1) {
                          $estado="Activo";
                        }else {
                          $estado="Inactivo";
                        }
                        echo "<input type='text' class='form-control' readonly value='$estado' name='estado' id='estado'>";?>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label> -</label>
                        <div class="d-flex">
                          <input type="submit" value="Guardar" class="btn btn-primary w-50 me-2" name="btnEditarProducto" id="btnEditarProducto">
                          <a type="submit" class="btn btn-danger w-50" href="producto.php">Regresar</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- general form elements disabled -->
            
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

<?php
  include("layout/footer.php");
?>

<script type="text/javascript">
  $(function() {
    $('#btnEditarRol').click(function() {
        var valid = this.form.checkValidity();
        if (valid) {
          return confirm('!Desea guardar los datos');
        } else {
            alert('Debe de rellenar los campos o coincidir con el formato indicado');
        }
        var rol = $('#rol').val();
        var descripcion = $('#descripcion').val();
    });
  });
</script>
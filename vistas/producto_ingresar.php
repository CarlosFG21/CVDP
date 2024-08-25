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
                <h3 class="card-title">Ingresar</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <?php 
              if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'existe'){
            ?>
             <div class="alert alert-danger alert-dismissible col-sm-6">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-exclamation-triangle"></i> Alerta!</h5>
                !El producto a ingresar ya existe.!
              </div>
            <?php
              }
            ?>
                <form role="form" method="post" action="../crud/productoingresar.php">
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                      <label>Categoria</label>
                      <select name="categoria" id="categoria" class="form-control">
                        <?php
                          include("../clases/CategoriaP.php");
                          $categoria = new Categoriap();
                          $categoriaArray = $categoria->ObtenerCategoriap();

                          for($i=0; $i<sizeof($categoriaArray); $i++){
                            $id = $categoriaArray[$i]->getIdcategoria();
                            $nombre = $categoriaArray[$i]->getNombre();
                            echo '<option value='.$id.'>'.$nombre.'</option>';
                          }
                        ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" class="form-control" placeholder="Nombre" name="nombre" id="nombre"
                         required minlength="3" maxlength="90">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Descripcion</label>
                        <input type="text" class="form-control" placeholder="Descripcion" name="descripcion" id="descripcion"
                        required minlength="3" maxlength="60">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Cantidad</label>
                        <input type="number" class="form-control" placeholder="Cantidad" name="cantidad" id="cantidad"
                        required required minlength="1" maxlength="7" step="0.1">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Precio</label>
                        <input type="number" class="form-control" placeholder="Precio" name="precio" id="precio"
                         required minlength="1" maxlength="9" step="0.1">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Ubicación</label>
                        <input type="text" class="form-control" placeholder="Ubicación" name="ubicacion" id="ubicacion"
                        pattern="^[a-zA-Záéíóú0-9]{1,30}" required minlength="1" maxlength="15">
                      </div>
                    </div>
                    </div> 
                  <div class="">
                  <input type="submit" value="Guardar" class="btn btn-primary " name="btnGuardarProducto" id="btnGuardarProducto">
                  <a type="submit" class="btn btn-danger" href="producto.php">Regresar</a>
                </div>     
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            
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
    $('#btnGuardarProducto').click(function() {

        var valid = this.form.checkValidity();
        if (valid) {
          return confirm('!Desea guardar los datos');
   
        } else {
            alert('Debe de rellenar los campos o coincidir con el formato indicado');
        }

        var nombre = $('#nombre').val();
        var descripcion = $('#descripcion').val();

    });

  });
</script>

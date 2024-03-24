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
            <h1>Roles</h1>
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
            
              include("../clases/Rol.php");
              $rol = new Rol();
              
              $id = $_REQUEST['id'];
              $rolArray = $rol->BuscarRol($id);

              $nombre = $rolArray->getNombre();
              $descripcion = $rolArray->getDescripcion();

               ?>
                <?php 
              if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'existe'){
            ?>
             <div class="alert alert-danger alert-dismissible col-sm-6">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-exclamation-triangle"></i> Alerta!</h5>
                !El rol a ingresar ya existe.!
              </div>
            <?php
              }
            ?>
                <form role="form" method="post" action="../crud/roleditar.php?id=<?php echo $id;?>">
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Tipo de rol</label>
                        <?php
                         echo "
                        <input type='text' class='form-control' placeholder='Rol' value='$nombre' name='rol' id='rol'
                        pattern='^[a-zA-Záéíóú0-9]{1,30}' required minlength='3' maxlength='15'>";
                        ?>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Descripción</label>
                        <?php
                        echo "
                        <input type='text' class='form-control' placeholder='Descripcion' value='$descripcion' name='descripcion' id='descripcion'
                        required pattern='^[a-zA-Záéíóú ]{1,30}' required minlength='3' maxlength='60'>";
                        ?>
                      </div>
                    </div>
                    </div> 
                  <div class="">
                  <input type="submit" value="Guardar" class="btn btn-primary " name="btnEditarRol" id="btnEditarRol">
                  <a type="submit" class="btn btn-danger" href="rol.php">Regresar</a>
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
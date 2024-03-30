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
            <h1>Clientes/Proveedores</h1>
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
            
            include("../clases/Persona.php");
            $persona = new Persona();
            
            $id = $_REQUEST['id'];

            $personaArray = $persona->BuscarPersona($id);

            $nombre = $personaArray->getNombre();
            $nit = $personaArray->getNit();
            $tipo = $personaArray->getTipo();

             ?>
              <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'existe'){
              ?>
               <div class="alert alert-danger alert-dismissible col-sm-6">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-exclamation-triangle"></i> Alerta!</h5>
                  !El cliente o proveedor a ingresar ya existe.!
                </div>
              <?php
                }
              ?>
              <!-- /.Validacion codigo php -->
                <form role="form" method="post" action="../crud/personaeditar.php?id=<?php echo $id;?>">
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Tipo</label>
                        <select class="form-control" name="tipo" id="tipo">
                        <?php
                          
                          if(strcmp($tipo, "Cliente") === 0){
                          echo "<option>Cliente</option>";
                          echo "<option>Proveedor</option>";
                          }

                          if(strcmp($tipo, "Proveedor") === 0){
                            echo "<option>Proveedor</option>";
                            echo "<option>Cliente</option>";
                            }

                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Nombre</label>
                        <?php
                         echo "
                        <input type='text' class='form-control' placeholder='Nombre' value='$nombre' name='nombre' id='nombre'
                        pattern='^[a-zA-Záéíóú ]{1,30}' required minlength='3' maxlength='15'>";
                        ?>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Nit</label>
                        <?php
                         echo "
                        <input type='number' class='form-control' placeholder='Nit' value='$nit' name='nit' id='nit'
                        pattern='^[0-9]{1,30}' required minlength='9' maxlength='9'>";
                        ?>
                      </div>
                    </div>
                  </div>  
                  <div class="">
                  <input type="submit" value="Guardar" class="btn btn-primary" name="btnEditarPersona" id="btnEditarPersona">
                  <a type="submit" class="btn btn-danger" href="persona.php">Regresar</a>
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

include('layout/footer.php');

?>

<script type="text/javascript">
$(function() {
    $('#btnEditarPersona').click(function() {

        var valid = this.form.checkValidity();
        if (valid) {
          return confirm('!Desea guardar los datos');
   
        } else {
            alert('Debe de rellenar los campos o coincidir con el formato indicado');
        }

        var tipo = $('#tipo').val();
        var nombre = $('#nombre').val();
        var nit = $('#nit').val();

    });

});
</script>
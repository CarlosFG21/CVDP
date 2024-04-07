<?php

include("../clases/Empleado.php");

?>

<?php

$empleado = new Empleado();
            
$id = $_REQUEST['id'];

$empleadoArray = $empleado->BuscarEmpleado($id);

$nombre = $empleadoArray->getNombre();
$apellido = $empleadoArray->getApellido();
$edad = $empleadoArray->getEdad();
$puesto = $empleadoArray->getPuesto();
$salario = $empleadoArray->getSalario();
$fecha_ent = $empleadoArray->getFecha();
$nom_con = $nombre. ' ' . ' ' . $apellido;
$estado = 1;


?>
         <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Nombre</label>
                        <?php
                       echo "<input type='text' class='form-control' value='$nom_con' name='salario' id='salario' disabled>";
                      ?>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Edad</label>
                        <?php
                        echo "
                        <input type='text' class='form-control' value='$edad' minlength='4' maxlength='8' required name='bonificacion' id='bonificacion' disabled pattern='^[a-zA-Záéíóú0-9.,_- ]{1,30}'>";
                        ?>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Puesto</label>
                        <?php 
                        echo "
                        <input type='text' class='form-control' value='$puesto' minlength='4' maxlength='8' required name='otros' id='otros' disabled pattern='^[a-zA-Záéíóú0-9.,_- ]{1,30}'>";
                        ?>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Salario</label>
                        <?php 
                        echo "
                        <input type='text' class='form-control' value='$salario' minlength='4' maxlength='8' required name='otros' id='otros' disabled pattern='^[a-zA-Záéíóú0-9.,_- ]{1,30}'>";
                        ?>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Fecha de entrada</label>
                        <?php 
                        echo "
                        <input type='text' class='form-control' value='$fecha_ent' minlength='4' maxlength='8' required name='otros' id='otros' disabled pattern='^[a-zA-Záéíóú0-9.,_- ]{1,30}'>";
                        ?>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Estado</label>
                        <?php 
                       if($estado == 1){
                        //$calculot = $salario * 0.013;
                        echo "
                        <input type='text' class='form-control' value='Activo' minlength='4' maxlength='8' required name='timbre' id='timbre' disabled pattern='^[a-zA-Záéíóú0-9.,_- ]{1,30}'>";
                        }else{
                            echo "
                            <input type='text' class='form-control' value='Activo' minlength='4' maxlength='8' required name='timbre' id='timbre' disabled pattern='^[a-zA-Záéíóú0-9.,_- ]{1,30}'>";
                        }
                        ?>
                      </div>
                    </div>
                  </div> 
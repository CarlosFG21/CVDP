<?php

include("../clases/CategoriaP.php");

if(isset($_POST["btnEditarCategotiap"])){

  $categoria = new Categoriap();

  $id = $_REQUEST['id'];
  $nombre = $_POST['categoriap'];
  $descripcion = $_POST['descripcion'];

  if($categoria->ValidarCategoriap($nombre)==0){

  $categoria->EditarCategotia($nombre,$descripcion,$id);

  header("Location: ../vistas/categoria_producto.php");

}else{

  header("Location: ../vistas/categoriap_editar.php?id=$id&mensaje=existe");

}




}




?>
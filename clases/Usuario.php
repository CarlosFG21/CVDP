<?php

include("../db/conexion.php");

class Usuario{


    public $clave;
    public $estado;
    public $idrol;
    public $idusuario;
    public $nombre;

    //creacion de los metodos get y set


    //----------------------------------------------------------------------------------

    //metodo get y set clave

    public function getClave(){
        return $this->clave;
    }

    public function setClave($_clave1){
        $this->clave = $_clave1;
    }


    //----------------------------------------------------------------------------------
    
    //metodo get y set estado

    public function getEstado(){
        return $this->estado;
    }

    public function setEstado($_estado1){
        $this->estado = $_estado1;
    }


    //---------------------------------------------------------------------------

    //metodo get y set id rol

    public function getIdrol(){
       return $this->idrol;
    }

    public function setIdrol($_idrol1){
        $this->idrol = $_idrol1;
    }

    //-----------------------------------------------------------------------------

    //metodo get y set id usuario

    public function getIdusuario(){

        return $this->idusuario;
    }

    public function setIdusuario($_idusuario1){
        $this->idusuario = $_idusuario1;
    
    }

    //------------------------------------------------------------------------------------
     

    //metodo get y set nombre 

    public function getNombre(){
        return $this-> nombre;

    }

    public function setNombre($_nombre1){
        $this->nombre = $_nombre1;
    }


    //funcion guardar
    public function GuardarUsuario($idrol,$nombre,$clave){
        
        $conexion = new conexion();
        $conexion->conectar();

        $sql = "insert into usuario(Id_Rol, Nombre, Clave) values(?,?,?)";
        $ejecutar = $conexion->db->prepare($sql);
        $ejecutar->bind_param('iss',$idrol,$nombre,$clave);
        $ejecutar->execute();
        
        $conexion->desconectar();
    }


    //funcion visualizar Usuarios
    public function ObtenerUsuarios(){
        
        $conexion = new conexion();
        $conexion->conectar();

        $resultadoUsuarios = array();

        $sql = "SELECT u.Id_Usuario, r.Nombre, u.Nombre, u.Clave, u.Estado FROM usuario u JOIN rol r on u.Id_Rol=r.Id_Rol";
        $ejecutar = mysqli_query($conexion->db,$sql);

        while($fila = mysqli_fetch_array($ejecutar)){

            $usuarioIndex = new Usuario();

            $usuarioIndex->setIdusuario($fila[0]);
            $usuarioIndex->setIdrol($fila[1]);
            $usuarioIndex->setNombre($fila[2]);
            $usuarioIndex->setClave($fila[3]);
            $usuarioIndex->setEstado($fila[4]);

            array_push($resultadoUsuarios,$usuarioIndex);

        }

        $conexion->desconectar();
        
        return $resultadoUsuarios;
    }


    //funcion editar
    public function EditarUsuario($idusuario,$idrol,$nombre,$clave){

      $conexion = new conexion();
      $conexion->conectar();

      $sql = "update usuario set id_rol=?, nombre=?, clave=? where id_usuario=?";
      $ejecutar = $conexion->db->prepare($sql);
      $ejecutar->bind_param('issi',$idrol,$nombre,$clave,$idusuario);
      $ejecutar->execute();

      $conexion->desconectar();

    }


    //funcion Buscar Usuario
    public function BuscarUsuario($idusuario) {
        $conexion = new conexion();
        $conexion->conectar();
    
        $usuarioArray = array(); // Inicializa un array vacío
    
        $sql = "SELECT * FROM usuario WHERE id_usuario=?";
        $ejecutar = $conexion->db->prepare($sql);
        $ejecutar->bind_param('i', $idusuario);
        $ejecutar->execute();
    
        // Obtiene el resultado de la consulta preparada
        $resultado = $ejecutar->get_result();
    
        // Recorre los resultados y crea objetos Usuario
        while ($fila = $resultado->fetch_array(MYSQLI_NUM)) {
            $usuario = new Usuario(); // Crea un nuevo objeto Usuario
            $usuario->setIdusuario($fila[0]);
            $usuario->setIdrol($fila[1]);
            $usuario->setNombre($fila[2]);
            $usuario->setClave($fila[3]);
            $usuario->setEstado($fila[4]);
            $usuarioArray[] = $usuario; // Agrega el objeto Usuario al array
        }
    
        $conexion->desconectar();
    
        return $usuarioArray;
    }
    
    
    //Funcion Eliminar
    public function EliminarUsuario($idusuario){

        $conexion = new conexion();
        $conexion->conectar();

        $estado = 0;

        $sql = "update usuario set estado=? where id_usuario=?";
        $ejecutar = $conexion->db->prepare($sql);
        $ejecutar->bind_param('ii',$estado, $idusuario);
        $ejecutar->execute();

        $conexion->desconectar();

    }


    //funcion Reactivar Usuario
    public function ReactivarUsuario($idusuario) {

        $conexion = new conexion();
        $conexion->conectar();

        $estado = 1;

        $sql = "update usuario set estado=? where id_usuario=?";
        $ejecutar = $conexion->db->prepare($sql);
        $ejecutar->bind_param('ii',$estado, $idusuario);
        $ejecutar->execute();

        $conexion->desconectar();

    }


    //funcion Validar
    public function ValidarUsuario($nombre){
        $conexion = new conexion();
        $conexion->conectar();
    
        $sql = "SELECT COUNT(*) FROM usuario WHERE Nombre=?";
        $stmt = $conexion->db->prepare($sql);
        $stmt->bind_param('s', $nombre);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
    
        $conexion->desconectar();
    
        return $count > 0;
    }

    

    public function ObtenerRoles(){
        
        $conexion = new conexion();
        $conexion->conectar();

        $resultadoRol = array();
        $sql = "SELECT Id_Rol, Nombre FROM rol";
        $ejecutar = mysqli_query($conexion->db,$sql);

        while($fila = mysqli_fetch_array($ejecutar)){

            $rolIndex = new Usuario();
            $rolIndex->setIdrol($fila[0]);
            $rolIndex->setNombre($fila[1]);
            array_push($resultadoRol,$rolIndex);
        }

        $conexion->desconectar();        
        return $resultadoRol;
    }


}

?>
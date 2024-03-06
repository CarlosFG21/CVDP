
<?php

class conexion{


    public $hostname="";
    public $username="";
    public $password="";
    public $dbname="";
    public $db;


    //metodo get


    //obtencion de nombre del host de la base de datos
    public function getHostname(){

        return $this->hostname;
    }

    //obtencion del usuario de la base de datos

    public function getUsername(){

        return $this->username;

    }

    //obtencion de la contraseña de la base de datos

    public function getPassword(){

        return $this->password;
    }

    //obtencion de la conexion de la base datos

    public function getDbname(){
        return $this->dbname;
    }

    //funcion para la conexion de la base datos

    public function conectar(){
        $this->db = mysql_connect($this->getHostname(),$this->getUsername(),$this->getPassword())
        or die("<html><script language='JavaScript'>alert('¡No es posible conectarse a la base de datos! Vuelve a intentarlo más tarde.'),history.go(-1)</script></html>");

        mysqli_select_db($this->db,$this->getDbname());
    }


    //funcion para desconectar la base de datos

    public function desconectar(){
        mysqli_close($this->db);
    }

}

?>
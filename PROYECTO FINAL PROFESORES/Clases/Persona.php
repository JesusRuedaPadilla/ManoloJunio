<?php
//  include_once "../helpers/ConexionBD.php"; 
//  include_once "../helpers/Login.php"; 
//  include_once "../helpers/Session.php"; 
//  include_once "../paginaInicio.php";
//  include_once "../paginaLogin.php";  

class Persona{
    
    protected $id;
    protected $nombre;
    protected $apellidos;
    protected $correo;
    protected $contraseña;
 

    public function getNombre() {return $this->nombre; }
    public function getApellidos() {return $this->apellidos; }
    public function getCorreo() {return $this->correo; }
    public function getContraseña() {return $this->contraseña; }
    public function getId() {return $this->id; }


    public function __construct($row) {

        $this->id = $row['id'];
        $this->nombre = $row['nombre'];
        $this->apellidos = $row['apellidos'];
        $this->correo = $row['correo'];
        $this->contraseña = $row['contrasena'];
  

    }
}
?>